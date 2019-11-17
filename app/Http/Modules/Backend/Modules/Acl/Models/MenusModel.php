<?php

namespace App\Http\Modules\Acl\Models;

use App\Http\Base\Models\BaseModel;
use App\Http\Modules\Acl\Library\AclLibraryTrait;
use DB;

class MenusModel extends BaseModel
{
	use AclLibraryTrait;

	public $columnParentMenu	= 'parent_menu';

	public function __construct (array $attributes = [])
	{
		parent::__construct($attributes);
		$this->table	= $this->moduleAclDbTableMenus;
	}

	public function getColumnList (): array
	{
		(array) $array	= [
			$this->table.'.id',
			$this->table.'.name',
			$this->table.'.parent_menu',
			$this->table.'.menu_order',
			$this->table.'.menu_level',
			$this->table.'.display_name',
			$this->table.'.url',
			$this->table.'.icon',
			$this->table.'.description',
			$this->table.'.status',
			$this->table.'.created_by',
			$this->table.'.updated_by',
			$this->table.'.created_at',
			$this->table.'.updated_at'
		];

		return $array;
	}

	public function parent ()
	{
		return $this->hasOne($this, $this->primaryKey, $this->columnParentMenu);
	}

	public function children ()
	{
		return $this->hasMany($this, $this->columnParentMenu, $this->primaryKey);
	}

	public function getMenus ()
	{
		$select	= $this->getColumnList();
		$query	= $this->select($select)
						->orderBy($this->table.'.'.$this->columnParentMenu, 'asc')
						->orderBy($this->table.'.menu_order', 'asc')
						;

		return $query;
	}

	public function getMenuOrder (int $id)
	{
		(array) $select	= [
			DB::raw('(select max(t.menu_order) from '.$this->table.' t where t.'.$this->columnParentMenu.' = m.'.$this->columnParentMenu.') as max_order'),
			DB::raw('(select min(t.menu_order) from '.$this->table.' t where t.'.$this->columnParentMenu.' = m.'.$this->columnParentMenu.') as min_order'),
			DB::raw('m.menu_order as menu_order'),
			DB::raw('m.'.$this->columnParentMenu.' as parent_menu')
		];

		(object) $query	= DB::table($this->table.' as m')
					->select($select)
					->where('m.'.$this->primaryKey, $id)
					->first()
					;

		return $query;
	}

	public function getMenusByRoles($roles)
	{
		$query	= $this->getMenus()
						->leftJoin('acl_menu_role', 'acl_menu_role.menu_id', '=', 'acl_menus.id')
						->whereIn('acl_menu_role.role_id', $roles)
						;

		return $query;
	}
}
