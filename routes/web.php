<?php

use Illuminate\Support\Facades\Route;
Use App\Users;
Use App\projectes;
Use App\empreses;
use Illuminate\Http\Request as Request;
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
Route::post('login', [ 'as' => 'login', 'uses' => 'AuthController@login']);

Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) {
        session()->put('locale', $locale);
    }else{
        session()->put('locale', 'es');
    }
    return redirect('/');
});

Route::get('/', function () {
    if(!App::getLocale()){
        return redirect('locale/es');
    }
    $pro = array(
        'actiu' =>1
    );

    $projs = projectes::where($pro)->get();
    return view('home',[ 'projs' => $projs ]);
})->name('/');

Route::get('log',function () {
    session()->forget('user');
    session()->forget('uinf');
    return view('welcome');
})->name('log');

Route::get('logout',function () {
    session()->forget('user');
    session()->forget('uinf');
    return redirect()->route('/');
})->name('logout');

Route::post('registre', [ 'as' => 'registre', 'uses' =>'Auth\RegistreController@registre']);


Route::get('welcome', function () {
    return view('welcome');
});

Route::get('users', function() {
    return Users::all();
});

// CRUD Usuaris
Route::get('users/{id}', function($id) {
    return Users::find($id);
});

Route::post('users', function(Request $request) {
    return Users::create($request->all);
});

Route::put('users/{id}', function(Request $request, $id) {
    $user = Users::findOrFail($id);
    $user->update($request->all());

    return $user;
});

Route::delete('users/{id}', function($id) {
    Users::find($id)->delete();

    return 204;
});
//---

//Projectes
Route::get('projecte/{id}/{emp}', function($id,$emp) {
    $proj = projectes::find($id);
    $emp = empreses::find($emp);
    return view('projectView',['proj' => $proj,
                               'emp' => $emp]);
});
Route::get('getops/{id}','AjaxController@index');
Route::get('getopsus/{id}','AjaxController@indexus');
//---

Route::middleware('auth:api')
    ->get('/user', function (Request $request) {
        return $request->user();
    });

Route::get('/home', 'HomeController@index')->name('home');
