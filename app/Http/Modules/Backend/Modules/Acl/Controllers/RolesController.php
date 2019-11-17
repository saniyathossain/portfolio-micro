<?php

namespace App\Http\Modules\Acl\Controllers;

use App\Http\Base\Controllers\ResourceController as Controller;
use App\Http\Modules\Acl\Library\AclLibraryTrait;
use App\Http\Modules\Core\Library\CoreLibraryTrait;
use Illuminate\Http\Request;

class RolesController extends Controller
{
	use AclLibraryTrait, CoreLibraryTrait;

	protected $crudName		= 'Role';
	protected $commonPivot	= 'menus';

	public function __construct ()
	{
		$this->crudModelName	= $this->moduleAclModelRoles;
		$this->formRequestClass	= $this->moduleAclRequestRoles;

		$this->crudIndexView	= $this->moduleCoreViewPagesDatatablesIndex;
		$this->crudFormView		= $this->moduleAclViewRolesForm;

		call_user_func_array([$this, 'parent::'.__FUNCTION__], []);
	}

	public function render ($action, $id = null, $data = [])
	{
		switch ($action):
			case 'index':
				(string) $primary_key	= resolve($this->crudModelName)->primaryKey ?? 'id';
				(string) $table			= resolve($this->crudModelName)->getTable();

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
				(object) $menus			= resolve($this->moduleAclModelMenus)->getMenus()->get();
				$data['menus']			= $this->getMenuTreeView($menus);
				$data['status_data']	= $this->statusData();

		endswitch;

		return call_user_func_array([$this, 'parent::'.__FUNCTION__], [$action, $id, $data]);
	}

	public function inputs ($request, $request_excepts = [])
	{
		$inputs	= call_user_func_array([$this, 'parent::'.__FUNCTION__], [$request, array_merge($request_excepts, [$this->commonPivot])]);

		if ($request->has($this->commonPivot)):
			$debug	= debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);
			$action	= $data['action'] ?? $debug[2]['function'];

			$inputs[$this->commonPivot]	= $request->input($this->commonPivot);
		endif;

		return $inputs;
	}
}