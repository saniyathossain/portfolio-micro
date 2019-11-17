<?php

namespace App\Http\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Adldap\Laravel\Facades\Adldap;
use App\Http\Modules\Auth\Library\AuthLibraryTrait;
use App\Http\Modules\Core\Library\CoreLibraryTrait;
use App\Http\Modules\Auth\Requests\AuthRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Cache;
use Session;

class AuthController extends Controller
{
	use AuthenticatesUsers, AuthLibraryTrait, CoreLibraryTrait;

	public function getSignin ()
	{
		$data['title']			= 'Signin';
		$data['user_agent_ie']	= $this->isIE();

		$view					= $this->moduleAuthViewPagesSignin;

		return view($view, $data);
	}

	public function postSignin (Request $request, AuthenticationException $exception)
	{
		$credentials	= $request->only(['username', 'password']);
		// $user		= Adldap::search()->users()->find('john doe');

		if ($this->guard()->attempt($credentials, true)):
			flash('Successfully Signed In..', 'success');
			return redirect()->intended('dashboard');
		else:
			return $this->unauthenticated($request, $exception);
		endif;
	}

	protected function unauthenticated ($request, AuthenticationException $exception)
	{
		if ($request->expectsJson()):
			return response()->json(['message' => $exception->getMessage()], 401);
		else:
			flash($exception->getMessage(), 'error');
			return redirect()->back()->withInput();
		endif;
	}

	public function getSignout (Request $request)
	{
		$this->guard()->logout();

        $request->session()->invalidate();

		flash('Successfully Signed Out..', 'success');
		return redirect()->intended('auth/signin');
	}
}