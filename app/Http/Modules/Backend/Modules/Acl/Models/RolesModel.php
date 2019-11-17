<?php

namespace App\Http\Modules\Acl\Models;

use App\Http\Base\Models\BaseModel;
use App\Http\Modules\Acl\Library\AclLibraryTrait;
use DB;

class RolesModel extends BaseModel
{
	use AclLibraryTrait;

	public function __construct (array $attributes = [])
	{
		parent::__construct($attributes);
		$this->table	= $this->moduleAclDbTableRoles;
	}

	public function menus ()
	{
		return $this->belongsToMany($this->moduleAclModelMenus, $this->moduleAclDbTableMenuRole, 'role_id', 'menu_id');
	}

	public function getRolesList ()
	{
		return $this->pluck('display_name', 'id')->toArray();
	}

	public function getRolesByUser (int $user_id = null)
	{
		if (empty($user_id)):
			$user_id	= auth()->check() ? auth()->user()->id : 0;
		endif;

		$query	= $this->leftJoin('acl_role_user', 'acl_role_user.role_id', '=', 'acl_roles.id')
						->select('acl_roles.id as role_id')
						->where('acl_role_user.user_id', $user_id)
						->pluck('role_id')
						;

		return $query;
	}
}