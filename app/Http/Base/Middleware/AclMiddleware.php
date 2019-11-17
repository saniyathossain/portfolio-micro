<?php

namespace App\Http\Base\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Modules\Core\Library\CoreLibraryTrait;
use App\Http\Modules\Acl\Library\AclLibraryTrait;

class AclMiddleware
{
	use CoreLibraryTrait, AclLibraryTrait;

	protected $auth;

    /**
     * Creates a new instance of the middleware.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
	public function __construct(Guard $auth)
	{
		// $this->auth	= $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
     *
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		(bool) $result = false;

		$roles  = resolve($this->moduleAclModelRoles)->getRolesByUser();
		$menus  = resolve($this->moduleAclModelMenus)->getMenusByRoles($roles)->get();

		$menuPermissions   = [];
		$routePath         = $request->getRequestUri();

		foreach ($menus as $menu):
			if (isset($menu->url) && !empty($menu->url)):
				$menu_url			= starts_with($menu->url, '/') ? $menu->url : '/'.$menu->url;
				$menuPermissions[]	= substr($menu_url, 1);

				if (starts_with($routePath, $menu_url)):
					$result	= true;
				endif;
			endif;
		endforeach;

		$session	= [
			'auth_user_roles'	=> $roles,
			'auth_user_menus'	=> $menus,
			'menus'				=> $menuPermissions
		];

		$this->storeSession($session);

		if (!$result):
			abort(403);
		endif;

		return $next($request);
	}
}
