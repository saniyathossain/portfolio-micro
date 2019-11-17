<?php

namespace App\Http\Modules\Acl\Controllers;

use App\Http\Base\Controllers\ResourceController as Controller;
use App\Http\Base\Traits\AssetsTrait;
use App\Http\Modules\Acl\Library\AclLibraryTrait;
use App\Http\Modules\Core\Library\CoreLibraryTrait;
use Illuminate\Http\Request;

class MenusController extends Controller
{
	use AssetsTrait, AclLibraryTrait, CoreLibraryTrait;

	protected $crudName	= 'Menu';

	public function __construct ()
	{
		$this->crudModelName	= $this->moduleAclModelMenus;
		$this->formRequestClass	= $this->moduleAclRequestMenus;

		$this->crudIndexView	= $this->moduleCoreViewPagesDatatablesIndex;
		$this->crudFormView		= $this->moduleAclViewMenusForm;

		call_user_func_array([$this, 'parent::'.__FUNCTION__], []);
	}

	public function render ($action, $id = null, $data = [])
	{
		switch ($action):
			case 'index':
				$primary_key	= resolve($this->crudModelName)->primaryKey ?? 'id';
				$table			= resolve($this->crudModelName)->getTable();

				$data['dataTableHtmlColumns']	= [
					['data'	=> $primary_key, 'name'	=> $table.'.'.$primary_key, 'title' => 'SL#'],
					['data'	=> 'name', 'name' => $table.'.name', 'title' => 'Name'],
					['data'	=> 'description', 'name' => $table.'.description', 'title' => 'Description'],
					['data'	=> 'created_at', 'name' => $table.'.created_at', 'title' => 'Created At'],
					['data'	=> 'action', 'name'	=> 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false, 'exportable' => false, 'printable' => false, 'class' => 'no-export']
				];

				break;

			case 'create':
			case 'edit':
				$css_files			= $this->cssFiles($public = $this->assetsPublicPath);

				$data['ion_icons']	= isset($css_files['cdn-font-ionicons-v4.4.8']) ? $this->listIcons(
																											$icon_file			= $css_files['cdn-font-ionicons-v4.4.8'],
																											$exclude_icons		= [],
																											$icon_css_prefix	= 'ion',
																											$prefix				= false
																										)
																					:
																					[]
																					;

				$data['fa_icons']	= $this->listFontAwesome5Icons();

				$data['icons']		= array_merge($data['ion_icons'], $data['fa_icons']);

				$menus				= resolve($this->crudModelName)->getMenus()->get();

				$data['menus']		= $this->getMenuTreeView($menus);

				$data['status_data']	= $this->statusData();

		endswitch;

		return call_user_func_array([$this, 'parent::'.__FUNCTION__], [$action, $id, $data]);
	}
}
