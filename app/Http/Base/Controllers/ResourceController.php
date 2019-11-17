<?php

namespace App\Http\Base\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Base\Interfaces\ResourceInterface;
use App\Http\Base\Traits\ResourceTrait;
use App\Http\Base\Traits\IconsTrait;

abstract class ResourceController extends Controller implements ResourceInterface
{
	use IconsTrait, ResourceTrait
	{
		ResourceTrait::__construct as private __resourceTraitConstruct;
	}

	/**
	 * __construct function
	 */
	public function __construct()
	{
		$this->__resourceTraitConstruct();
	}

	/**
	 * index
	 *
	 * @return void
	 */
	public function index()
	{
		return $this->render(__FUNCTION__, null);
	}

	/**
	 * create
	 *
	 * @return void
	 */
	public function create()
	{
		return $this->render(__FUNCTION__);
	}

    /**
     * store
     *
     * @param  Illuminate\Http\Request $request
     *
     * @return void
     */
	public function store(Request $request)
	{
		return $this->crud($this->formRequest() ?? $request);
	}

	/**
	 * show
	 *
	 * @param  mixed $id
	 *
	 * @return void
	 */
	public function show($id)
	{
		return $this->render(__FUNCTION__, $id);
	}

	/**
	 * edit
	 *
	 * @param  mixed $id
	 *
	 * @return void
	 */
	public function edit($id)
	{
		return $this->render(__FUNCTION__, $id);
	}

    /**
     * update
     *
     * @param  Illuminate\Http\Request $request
     * @param  mixed $id
     *
     * @return void
     */
	public function update (Request $request, $id)
	{
		return $this->crud($this->formRequest() ?? $request, $id);
	}

    /**
     * destroy
     *
     * @param  Illuminate\Http\Request $request
     * @param  mixed $id
     *
     * @return void
     */
	public function destroy (Request $request, $id)
	{
		return $this->crud($request, $id);
	}
}
