<?php

namespace App\Http\Modules\Acl\Library;
use Illuminate\Http\Request;
use Route;

trait AclLibraryTrait
{
	// Controller
	public $moduleAclControllerMenus	= 'App\Http\Modules\Acl\Controllers\MenusController';
	public $moduleAclControllerRoles	= 'App\Http\Modules\Acl\Controllers\RolesController';
	public $moduleAclControllerUsers	= 'App\Http\Modules\Acl\Controllers\UsersController';

	// Models
	public $moduleAclModelMenus	= 'App\Http\Modules\Acl\Models\MenusModel';
	public $moduleAclModelRoles	= 'App\Http\Modules\Acl\Models\RolesModel';
	public $moduleAclModelUsers	= 'App\Http\Modules\Acl\Models\UsersModel';

	// Requests
	public $moduleAclRequestMenus	= 'App\Http\Modules\Acl\Requests\MenusRequest';
	public $moduleAclRequestRoles	= 'App\Http\Modules\Acl\Requests\RolesRequest';
	public $moduleAclRequestUsers	= 'App\Http\Modules\Acl\Requests\UsersRequest';

	// DB tables
	public $moduleAclDbTableMenus	= 'acl_menus';
	public $moduleAclDbTableRoles	= 'acl_roles';
	public $moduleAclDbTableUsers	= 'acl_users';

	public $moduleAclDbTableMenuRole	= 'acl_menu_role';
	public $moduleAclDbTableRoleUser	= 'acl_role_user';

	// Views
	public $moduleAclViewMenusForm	= 'Acl::menus-form';
	public $moduleAclViewRolesForm	= 'Acl::roles-form';
	public $moduleAclViewUsersForm	= 'Acl::users-form';

	public function getMenuTreeView ($menus, &$result = [], int $parent_menu = 0, int $depth = 0)
	{
		// filter only menus under current "parent"
		$Menus	= $menus->filter(function ($item) use ($parent_menu)
		{
			return $item->parent_menu	== $parent_menu;
		});

		if (!empty($Menus)):
			foreach ($Menus as $menu):
				$repeat_string				= str_repeat('&nbsp;', 6); // '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$parent_indicator_string	= '<i class="ion-arrow-right-c text-purple"></i>&nbsp;&nbsp;';
				$order_prefix				= str_repeat($repeat_string, $depth).$parent_indicator_string;

				$result[$menu->id]	= $order_prefix.'<i class="'.$menu->icon.'"></i> '.$menu->name;
				$this->getMenuTreeView($menus, $result, $menu->id, $depth + 1);
			endforeach;
		endif;

		return $result;
	}

	public function dynamicMenu (array $menus, int $parent_menu = 0, array $parents = []): string
    {
		(string) $current_url	= Route::current()->uri;
		(string) $menu_html		= '';

		if (!empty($menus)):
			if ($parent_menu == 0):
				foreach ($menus as $element):
					if (($element['parent_menu'] != 0) && !in_array($element['parent_menu'], $parents)):
						$parents[]	= $element['parent_menu'];
					endif;
				endforeach;
			endif;

			foreach ($menus as $element):
				if (session()->has('menus')):
					(array) $acl_menus	= session('menus');

					if (in_array($element['url'], $acl_menus)):
						(string) $active	= (starts_with($current_url, $element['url']) != false ? 'active' : '');
						(string) $icon		= ($element['icon'] != '' ? '<i class="'.$element['icon'].'"></i> ' : '');
						(string) $url		= ($element['url'] != '' ? url($element['url']) : 'javascript:void(0)');

						if ($element['parent_menu'] == $parent_menu):

							if (in_array($element['id'], $parents)):
								$menu_html	.= '<li class="'.$active.'">';
								$menu_html	.= '<a href="'.$url.'">'.$icon.'<span>'.$element['name'].'</span><span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span></a>';
							else:
								$menu_html	.= '<li class="'.$active.'">';
								$menu_html	.= '<a href="'.$url.'">'.$icon.'<span>'.$element['name'].'</span></a>';
							endif;

							if (in_array($element['id'], $parents)):
								$menu_html	.= '<ul class="treeview-menu">';
									$menu_html	.= '<li class="treeview '.$active.'">'.$this->dynamicMenu($menus, $element['id'], $parents).'</li>';
								$menu_html	.= '</ul>';
							endif;

							$menu_html	.= '</li>';
						endif;
					endif;
				endif;
			endforeach;
		endif;

		return $menu_html;
	}
}
