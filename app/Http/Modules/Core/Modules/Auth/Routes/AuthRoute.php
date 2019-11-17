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

use App\Http\Base\Library\BaseLibrary;

$module_controller_name = resolve(BaseLibrary::class)->getModuleControllerName();

Route::get('signin', $module_controller_name.'@getSignin')->name('login');

Route::post('signin',
[
	'as'   => 'auth.postSignin',
	'uses' => $module_controller_name.'@postSignin'
]);

Route::get('signout',
[
	'as'   => 'auth.getSignout',
	'uses' => $module_controller_name.'@getSignout'
])->middleware('auth');
