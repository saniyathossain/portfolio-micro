<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('menus', 'MenusController')->except(['show', 'destroy'])->middleware('acl');
Route::resource('users', 'UsersController')->except(['show', 'destroy'])->middleware('acl');
Route::resource('roles', 'RolesController')->except(['show', 'destroy'])->middleware('acl');