<?php

namespace App\Http\Modules\Auth\Library;

trait AuthLibraryTrait
{
	// Controllers
	public $moduleAuthController	= 'App\Http\Modules\Auth\Controllers\AuthController';

	// Models
	public $moduleAuthModel	= 'App\Http\Modules\Auth\Models\UsersModel';

	// Views
	public $moduleAuthViewPagesSignin	= 'Auth::pages.signin';
}
