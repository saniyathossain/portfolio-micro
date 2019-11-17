<?php

namespace App\Http\Base\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Datatables;
use App\Http\Base\Library\BaseLibrary;
use Yajra\DataTables\Html\Builder;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

/**
 * ResourceTrait
 *
 */
trait ResourceTrait
{
	protected $crudName;
	protected $resource;
	protected $currentRouteName;
	protected $resourceApi;
	protected $routePrefix;
	protected $routeApiPrefix	= 'api';
	protected $backslash		= '\\';
	protected $crudControllerName;
	protected $crudModelName;
	protected $crudTableName;

	protected $formRequestClass;

	protected $unsetInputs		= [];
	protected $commonPivot;
	protected $storePivot;
	protected $updatePivot;
	protected $destroyPivot;

	protected $crudIndexView;
	protected $crudShowView;
	protected $crudFormView;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->routePrefix			= $this->routePrefix ?? request()->segment(1);
		$this->resource				= str_slug(strtolower(str_plural($this->crudName)), '-');
		$this->resourceApi			= sprintf('%s%s%s%s', $this->backslash, $this->routeApiPrefix, $this->backslash, str_slug(strtolower(str_plural($this->crudName)), '-'));

		$this->currentRouteName		= Route::currentRouteName();
		$this->crudControllerName	= sprintf('%s%s', $this->backslash, get_class($this));
		$this->crudTableName		= (new $this->crudModelName)->getTable();

		if (!empty($this->commonPivot)):
			$this->storePivot	= $this->updatePivot	= $this->destroyPivot	= $this->commonPivot;
		endif;
	}

	/**
	 * formRequest
	 *
	 * @return void
	 */
	public function formRequest()
	{
		return !empty($this->formRequestClass) ? resolve($this->formRequestClass) : request();
	}

	/**
	 * inputs
	 *
	 * @param  mixed $request
	 * @param  array $request_excepts
	 *
	 * @return void
	 */
	public function inputs($request, array $request_excepts = [])
	{
		$input_excepts	= empty($request_excepts) ? array_merge(['_token', '_method', '_submit_redirect'], $request_excepts) : [];
		return $this->cleanInputs($request->except($input_excepts));
	}

	/**
	 * cleanInputs
	 *
	 * @param  mixed $inputs
	 *
	 * @return array
	 */
	public function cleanInputs($inputs)
	{
        if (!empty($inputs)):
            foreach ($inputs as $key => $value):
                $inputs[$key] = !is_array($value) ? e(trim($value)) : $value;
            endforeach;
        endif;

		return $inputs;
	}

	/**
	 * render
	 *
	 * @param  string $action
	 * @param  int $id
	 * @param  array $data
	 *
	 * @return void
	 */
	public function render($action, $id = null, array $data = [])
	{
		$request					= request();
		$data['resource']			= $resource	= $this->resource;
		$data['title']				= property_exists($this->crudControllerName, 'crudName') ? title_case($action).' '.$this->crudName : '';
		$data['icon']				= property_exists($this->crudControllerName, $action.'Icon') ? $this->{$action.'Icon'} : null;
		$data['reloadIcon']			= property_exists($this->crudControllerName, 'reloadIcon') ? $this->reloadIcon : null;

		$data['crudName']			= $this->crudName;
		$data['crudControllerName']	= $this->crudControllerName;

		$view;

		switch ($action):
			case 'index':
				$data['title']	= property_exists($this->crudControllerName, 'crudName') ? str_plural($this->crudName) : '';
				$table			= $this->crudTableName;
				$primary_key	= (new $this->crudModelName)->primaryKey ?? 'id';

				if (!isset($data['noDataTable']) || (isset($data['noDataTable']) && $data['noDataTable'] != false)):
					if ($request->ajax()):
						if (!array_key_exists('dataTableQuery', $data)):
							$datatable_columns		= $this->getModelTableColumns();
							$data['dataTableQuery']	= ($this->crudModelName)::select($datatable_columns);
						endif;

						if (!array_key_exists('dataTableData', $data)):
							$data['dataTableData']  = Datatables::of($data['dataTableQuery'])
																->editColumn($primary_key, function($table) use($primary_key)
																{
																	return '<span class="label label-primary">'.$table->{$primary_key}.'</span>';
																})
																->editColumn('created_at', function($table)
																{
																	$created_at = $table->created_at;
																	return '<span data-toggle="tooltip" title="'.$created_at->diffForHumans().'">'.(new Carbon($created_at))->format('F j, Y h:i A').'</span>';
																})
																->filterColumn('created_at', function($query, $keyword)
																{
																	$sql = 'format('.$this->crudTableName.'.created_at, \'MMMM dd, yyyy hh:mm tt\') like ? ';
																	$query->whereRaw($sql, ["%{$keyword}%"]);
																})
																->addColumn('action', function($table) use($data, $primary_key)
																{
																	// $action_form = '';

																	// if (Route::has($data['resource'].'.destroy')):
																	// 	$action_form .= '<form method="POST" action="'.action($this->crudControllerName.'@destroy', [$table->{$primary_key}]).'" accept-charset="UTF-8" data-confirm data-confirm-message="'.resolve(BaseLibrary::class)->messageDeleteConfirm.'">';
																	// 	$action_form .= method_field('DELETE');
																	// 	$action_form .= csrf_field();
																	// endif;

																	// if (Route::has($data['resource'].'.show')):
																		// $action_form .= '<a href="'.action($this->crudControllerName.'@show', [$table->{$primary_key}]).'" class="btn btn-sm btn-info" data-toggle="tooltip" title="View">'.$this->viewIcon.'</a>';
																	// endif;

																	if (Route::has($data['resource'].'.edit')):
																		// $action_form .= ' <a href="'.action($this->crudControllerName.'@edit', [$table->{$primary_key}]).'" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">'.$this->editIcon.'</a>';
																		$action_form = ' <a href="'.$this->resource.'/'.$table->{$primary_key}.'/edit" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">'.$this->editIcon.'</a>';
																	endif;

																	// if (Route::has($data['resource'].'.destroy')):
																		// $action_form .= ' <button class="btn btn-sm btn-danger" type="submit" data-toggle="tooltip" title="Delete">'.$this->deleteIcon.'</button>';
																		// $action_form .= '</form>';
																	// endif;

																	return $action_form;
																})
																->rawColumns([
                                                                    $primary_key,
                                                                    'created_at',
                                                                    'action'
                                                                ])
																->toJson()
																;

							return $data['dataTableData'];
						endif;
					endif;

					if (!array_key_exists('dataTable', $data)):
						$htmlBuilder	= resolve(Builder::class);

						$htmlColumns	= $data['dataTableHtmlColumns'] ?? [
							['data'	=> $primary_key, 'name'	=> $table.'.'.$primary_key, 'title' => 'SL#'],
							['data'	=> 'created_at', 'name' => $table.'.created_at', 'title' => 'Created At'],
							['data'	=> 'action', 'name'	=> 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false, 'exportable' => false, 'printable' => false, 'class' => 'no-export']
						];

						$data['dataTable']	= $htmlBuilder->columns($htmlColumns);
					endif;
				endif;

				$view	= $this->crudIndexView;
				break;

			case 'show':
			case 'edit':
				if (!array_key_exists('Model', $data)):
					try
					{
						$crudModelName				= $this->crudModelName;
						$columns					= $this->getModelTableColumns();
						$Model						= $crudModelName::select($columns);
						$data['Model']				= class_exists(ActiveScope::class) ? $Model->withoutGlobalScopes([ActiveScope::class])->findOrFail($id) : $Model->findOrFail($id);
						// $data['Model_Attributes']	= $data['Model']->getAttributes() ?? [];
					}
					catch (ModelNotFoundException $e)
					{
						$debug			= config('app.debug');
						$error_message	= ($debug !== false) ? $e->getMessage() : resolve(BaseLibrary::class)->messageModelNotFoundException;
						$error_action	= property_exists($this->crudControllerName, 'crudControllerName') ? (Route::has($resource.'.index') ? redirect(action($this->crudControllerName.'@index')) : url('/')) : redirect()->back();

						(array) $error_response_data	= [
							'type'		=> 'error',
							'message'	=> $error_message,
							'action'	=> $error_action
						];

						return $this->response($error_response_data);
					}
				endif;

				$view	= $this->crudFormView;
				break;

			case 'show':
				$view	= $this->crudShowView;
				break;

			case 'create':
				$view	= $this->crudFormView;
                break;

            default:
                break;
		endswitch;

		if (!empty($view)):
			return !$request->ajax() ? view($view, $data) : response()->json(view($view, $data)->render());
		else:
			return $data;
		endif;
	}

	/**
	 * crud
	 *
	 * @param  mixed $request
	 * @param  mixed $id
	 * @param  array $data
	 *
	 * @return void
	 */
	public function crud($request, $id = null, $data = [])
	{
		$class		= $this->crudControllerName;
		$debug		= debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
		$action		= $data['action'] ?? $debug[1]['function'];
		// $action		= $request->get('_method');

		$inputs	= $this->inputs($request);

		$model	= [
			'name'	=> $this->crudModelName,
			'id'	=> $id,
			'type'	=> $action
		];

		if (array_key_exists($this->{$action.'Pivot'}, $inputs)):
			if (property_exists($class, $action.'Pivot')):
				$model	= array_add($model, 'pivot_name', $this->{$action.'Pivot'});
				$model	= array_add($model, 'pivot_data', $inputs[$this->{$action.'Pivot'}]);
				$inputs	= array_except($inputs, [$this->{$action.'Pivot'}]);
			endif;
		endif;

		if (property_exists($class, 'unsetInputs')):
			if (!empty($this->unsetInputs) && is_array($this->unsetInputs)):
				$model	= array_add($model, 'unset', $this->unsetInputs);
			endif;
		endif;

		$action_text	= ($action != 'destroy') ? $action : 'delete';

		$route_success	= action($this->crudControllerName.'@index');
		$route_error;

		switch ($action):
			case 'update':
				$route_error	= action($this->crudControllerName.'@edit', [$id]);
				break;

			case 'store':
				$route_error	= action($this->crudControllerName.'@create');
				break;

			case 'destroy':
			default:
				$route_error	= $route_success;
				break;
		endswitch;

		(array) $messages	= [
			'success'	=> 'Successfully '.$action_text.'d '.strtolower($this->crudName).'.',
			'error'		=> 'Error while '.$action_text.'ing '.strtolower($this->crudName).'.'
		];

		(array) $redirects	= [
			'success'	=> $route_success,
			'error'		=> $route_error
		];

		if ($request->has('_submit_redirect')):
			$redirects['success']	= $request->input('_submit_redirect');
		endif;

		if (!empty($data)):
			foreach ($data as $key => $value):
				$$key	= $value;
			endforeach;
		endif;

		return $this->crudOperation($model, $inputs, $messages, $redirects);
	}

	/**
	 * response
	 *
	 * @param  array $response
	 *
	 * @return void
	 */
	public function response(array $response = [])
	{
		$request	= request();

		foreach ($response as $key => $value):
			$$key	= $value;
		endforeach;

		if (isset($type) && !isset($code)):
			$code	= resolve(BaseLibrary::class)->systemShortErrorMessages($type);
		endif;

		if (!$request->ajax()):
			if (isset($message) && isset($type)):
				flash($message, $type);
			endif;

			if (isset($action) && !isset($validation)):
				return !empty($action) ? redirect($action) : redirect()->back();
			endif;

			if (!isset($action) && isset($validation) && !empty($response['validation'])):
				return redirect()->back()->withErrors($response['validation']);
			endif;
		else:
			$json	= $response;
			$response['code']	= $code ?? 200;

			return response()->json($json);
		endif;
	}

	/**
	 * getModelTableColumns
	 *
	 * @param  string $model
	 *
	 * @return array
	 */
	public function getModelTableColumns($model = null): array
	{
		if (empty($model)):
			$model	= $this->crudModelName;
			$table	= $this->crudTableName;
		else:
			$table	= (new $model)->getTable();
		endif;

		return method_exists($model, 'getColumns') ? (new $model)->getColumns() : explode(',', ($table.'.'.implode(','.$table.'.', Schema::getColumnListing($table))));
	}

	/**
	 * crudOperation - method for crud operations (create, update or delete)
	 *
	 * @param  array  $model      model class name for elequent query
	 * @param  array  $input      array of all inputs
	 * @param  array  $messages   array of messages, includes success and error messages
	 * @param  array  $redirects  array of redirect messages for success or error
	 * @return redirects/json     redirects to path for suucess or validation error or returns json response if ajax request for both cases
	 *
	 * @author Saniyat Hossain [saniyat1000@gmail.com]
	 */
	public function crudOperation($model, $input, $messages, $redirects)
	{
		$request	= request();
		$model_name	= $model['name'];

		/*if (array_key_exists('validation', $model)):
			$validate  = $model['validation'];

			if (property_exists($model_name, $model['validation'])):
				if (array_key_exists('validation_messages', $model) && property_exists($model_name, $model['validation_messages'])):
					$validation_messages_property	= $model['validation_messages'];
					$validator						= Validator::make($input, $model_name::$$validate, $model_name::$$validation_messages_property);
				else:
					$validator = Validator::make($input, $model_name::$$validate);
				endif;

				// check if validation fails
				if ($validator->fails()):
					// check if request is ajax
					if (!$request->ajax()):
						// if request is not ajax then redirect back with validation errors
						return redirect()->back()->withErrors($validator)->withInput();
					else:
						// if request ajax then return json response with validation errors
						$json = [
							'status'		=> 'error',
							'code'			=> 422,
							'message'		=> 'validate.error',
							'errors'	=>  $validator->messages()->toJson()
						];

						// return json response
						return response()->json($json, $json['code']);
					endif;
				endif;
			endif;
		endif;*/

		if (array_key_exists('unset', $model)):
			if (!empty($model['unset']) && is_array($model['unset'])):
				foreach ($model['unset'] as $unset_key):
					unset($input[$unset_key]);
				endforeach;
			endif;
		endif;

		// return response()->json($input, 422);

		// switch with the create, update or delete method and qurey through it
		if (array_key_exists('type', $model)):
			switch ($model['type']):
				case 'create':
				case 'store':
				case 'add':
				case 'save':

					// start transaction
					DB::beginTransaction();

					try
					{
						$model_data = new $model_name;
						$Model      = $model_data->create($input);

						if (array_key_exists('pivot_name', $model) && array_key_exists('pivot_data', $model)):
							if (!empty($model['pivot_data'])):
								if (method_exists($model_name, $model['pivot_name'])):
									$pivot = $Model->{$model['pivot_name']}()->sync($model['pivot_data']);
								endif;
							endif;
						endif;
					}
					catch (Exception $e)
					{
						// transaction rollback
						DB::rollback();

						$e_message = $e->getMessage();

						if (!$request->ajax()):
							// laracasts flash messages for success if error occurs
							flash($e_message, 'error');
							// redirect to success route
							return redirect()->back()->withInput();
						else:
							// if request ajax then return json response with error message
							$json = [
								'status'		=> 'error',
								'code'			=> 400,
								'message'		=> 'action.error',
								'html_message'	=> $e_message
							];

							// return json response
							return response()->json($json, $json['code']);
						endif;
					}

					break;

				case 'insert':
				case 'bulk-insert':

					// start transaction
					DB::beginTransaction();

					try
					{
						// $id_field = Schema::getColumnListing((new $model_name)->table)[0];
						// $max_id   = $model_name::max($id_field);

						$Model = $model_name::insert($input);
					}
					catch (Exception $e)
					{
						$e_message = $e->getMessage();

						if (!$request->ajax()):
							// laracasts flash messages for success if error occurs
							flash($e_message, 'error');
							// redirect to success route
							return redirect()->back()->withInput();
						else:
							// if request ajax then return json response with error message
							$json = [
								'status'		=> 'error',
								'code'			=> 400,
								'message'		=> 'action.error',
								'html_message'	=> $e_message
							];

							// return json response
							return response()->json($json, $json['code']);
						endif;
					}

					break;

				case 'edit':
				case 'update':

					// start transaction
					DB::beginTransaction();

					try
					{
						// return response()->json(['model' => $model]);

						$model_data = class_exists(ActiveScope::class) ? $model_name::withoutGlobalScopes([ActiveScope::class])->findOrFail($model['id']) : $model_name::findOrFail($model['id']);
						$Model      = $model_data->update($input);

						if (array_key_exists('pivot_name', $model) && array_key_exists('pivot_data', $model)):
							if (!empty($model['pivot_data'])):
								if (method_exists($model_name, $model['pivot_name'])):
									$model_data->{$model['pivot_name']}()->sync($model['pivot_data']);
								endif;
							endif;
						endif;
					}
					catch (Exception $e)
					{
						// transaction rollback
						DB::rollback();

						$e_message = $e->getMessage();

						if (!$request->ajax()):
							// laracasts flash messages for success if error occurs
							flash($e_message, 'error');
							// redirect to success route
							return redirect()->back()->withInput();
						else:
							// if request ajax then return json response with error message
							$json = [
								'status'		=> 'error',
								'code'			=> 400,
								'message'		=> 'action.error',
								'html_message'	=> $e_message
							];

							// return json response
							return response()->json($json, $json['code']);
						endif;
					}

					break;

				case 'delete':
				case 'remove':
				case 'destroy':

					// start transaction
					DB::beginTransaction();

					try
					{
						$model_data = class_exists(ActiveScope::class) ? $model_name::withoutGlobalScopes([ActiveScope::class])->findOrFail($model['id']) : $model_name::findOrFail($model['id']);
						$Model      = $model_data->delete();

						if (array_key_exists('pivot_name', $model) && array_key_exists('pivot_data', $model)):
							if (!empty($model['pivot_data'])):
								if (method_exists($model_name, $model['pivot_name'])):
									$pivot = $model_data->{$model['pivot_name']}()->sync($model['pivot_data']);
								endif;
							endif;
						endif;
					}
					catch (Exception $e)
					{
						// transaction rollback
						DB::rollback();

						/*$e_message = $e->getMessage();

						if (!$request->ajax()):
							// laracasts flash messages for success if error occurs
							flash($e_message, 'error');
							// redirect to success route
							return redirect()->back();
						else:
							// if request ajax then return json response with error message
							$json = [
								'status'		=> 'error',
								'code'			=> 400,
								'message'		=> 'action.error',
								'html_message'	=> $e_message
							];

							// return json response
							return response()->json($json, $json['code']);
						endif;*/
					}
					break;
			endswitch;
		endif;

		// transaction commit
		DB::commit();

		if (array_key_exists('last_inserted_id_edit', $redirects)):
			// $id_field = \Schema::getColumnListing((new $model_name)->getTable())[0];
			// get the primary key of model
			$id_field	= (new $model_name)->getKeyName();
			$last_id	= $Model->{$id_field};

			// if no error occurs then check for request
			if (!$request->ajax()):
				// laracasts flash messages for success if no error occurs
				flash($messages['success'], 'success');
				// redirect to success route
				return redirect($redirects['success'].'/'.$last_id.'/edit');
			// if request ajax then return json response with success message
			else:
				$json = [
					'status'		=> 'success',
					'code'			=> 200,
					'message'		=> 'action.success',
					'last_id'       => $last_id,
					'html_message'	=> $messages['success']
				];

				// return json response
				return response()->json($json, $json['code']);
			endif;
		else:
			// if no error occurs then check for request
			if (!$request->ajax()):
				// laracasts flash messages for success if no error occurs
				flash($messages['success'], 'success');
				// redirect to success route
				return redirect($redirects['success']);
			// if request ajax then return json response with success message
			else:
                // get the primary key of model
                $id_field	= (new $model_name)->getKeyName();
                $last_id	= $Model->{$id_field} ?? 0;

				$json = [
					'status'		=> 'success',
					'code'			=> 200,
					'message'		=> 'action.success',
                    'last_id'       => $last_id,
					'html_message'	=> $messages['success']
				];

				// return json response
				return response()->json($json, $json['code']);
			endif;
		endif;
	}
}
