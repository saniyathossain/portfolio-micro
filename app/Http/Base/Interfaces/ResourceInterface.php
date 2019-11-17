<?php

namespace App\Http\Base\Interfaces;

use Illuminate\Http\Request;

interface ResourceInterface
{
	/**
	 * index
	 *
	 * @return void
	 */
    public function index();

	/**
	 * create
	 *
	 * @return void
	 */
    public function create();


    /**
     * store
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request);

	/**
	 * show
	 *
	 * @param  mixed $id
	 *
	 * @return void
	 */
    public function show($id);

	/**
	 * edit
	 *
	 * @param  mixed $id
	 *
	 * @return void
	 */
    public function edit($id);

    /**
     * update
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $id
     *
     * @return void
     */
    public function update(Request $request, $id);

    /**
     * destroy
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $id
     *
     * @return void
     */
	public function destroy(Request $request, $id);
}
