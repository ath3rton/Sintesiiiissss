<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\projectes;
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
Route::post('projadd', 'ProjectesController@store')->name('projadd');
Route::put('projmodficar/{proj}', 'ProjectesController@update')->name('projmodficar');
Route::get('projdel/{id}', 'ProjectesController@delete')->name('projdel');


// crud empresa
Route::post('empresa', 'EmpresaController@store')->name('creaempresa');

Route::delete('empresa/{empresa}', 'EmpresaController@delete');