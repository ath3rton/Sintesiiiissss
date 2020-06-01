<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// crud usuaris
Route::get('users', 'UsersController@index');
Route::get('users/{user}', 'UsersController@show');
Route::post('users', 'UsersController@store');
Route::put('users/{user}', 'UsersController@update');
Route::delete('users/{user}', 'UsersController@delete');
Route::post('logout', 'Auth\LoginController@logout');

//crud projectes
Route::get('projectes', 'ProjectesController@index');
Route::get('projectes/{projecte}', 'ProjectesController@show');
Route::post('projectes', 'ProjectesController@store');
Route::put('projectes/{projecte}', 'ProjectesController@update');
Route::delete('projectes/{projecte}', 'ProjectesController@delete');

// crud empresa
Route::get('empresa', 'EmpresaController@index');
Route::get('empresa/{empresa}', 'EmpresaController@show');
Route::post('empresa', 'EmpresaController@store');
Route::put('empresa/{empresa}', 'EmpresaController@update');
Route::delete('empresa/{empresa}', 'EmpresaController@delete');