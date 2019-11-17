<?php

namespace App\Http\Modules\Acl\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Http\Base\Traits\BaseModelTrait;
use App\Http\Base\Traits\EloquentTrait;
use App\Http\Modules\Acl\Library\AclLibraryTrait;

class UsersModel extends Authenticatable
{
	use BaseModelTrait, EloquentTrait, AclLibraryTrait, Notifiable;

	public $dateFormat	= 'Y-m-d H:i:s.u0';
	public $guarded		= ['created_by', 'updated_by', 'created_at', 'updated_at'];
	protected $hidden	= ['password', 'remember_token'];

	public function __construct()
	{
		$this->table	= $this->moduleAclDbTableUsers;
	}

	public function roles ()
	{
		return $this->belongsToMany($this->moduleAclModelUsers, $this->moduleAclDbTableRoleUser, 'user_id', 'role_id');
	}
}
