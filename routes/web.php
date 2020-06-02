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

// Lengua
Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) {
        session()->put('locale', $locale);
    }else{
        session()->put('locale', 'es');
    }
    return redirect('/');
});
// Raiz proyectos
Route::get('/', function () {
    if(!App::getLocale()){
        return redirect('locale/es');
    }
    $pro = array(
        'actiu' =>1,
        'estat' => 'Obert'
    );

    $projs = projectes::where($pro)->get();
    return view('home',['projs' => $projs,
                        'mod' => false ]);
})->name('/');

Route::get('/home', 'HomeController@index')->name('home');

// Login forms
Route::get('welcome', function () {
    return view('welcome');
});

Route::get('log',function () {
    session()->forget('user');
    session()->forget('uinf');
    return view('welcome');
})->name('log');

Route::post('registre', [ 'as' => 'registre', 'uses' =>'Auth\RegistreController@registre']);

// logout
Route::get('logout',function () {
    session()->forget('user');
    session()->forget('uinf');
    return redirect()->route('/');
})->name('logout');



// CRUD Usuaris
Route::get('users', function() {
    return Users::all();
});

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

Route::post('visitor', 'UsersController@visitor')->name('visitor');
//---

//Projectes
Route::get('projecte/{id}/{emp}', function($id,$emp) {
    $proj = projectes::find($id);
    $emp = empreses::find($emp);
    return view('projectView',['proj' => $proj,
                               'emp' => $emp,
                               'mod' => false]);
});

Route::get('projcreate', function() {
    return view('projectCreate',['proj' => null]);
})->name('projcreate');

Route::get('projmod', function() {
    $opc = ['emp_id' => session()->get('user')->id];
    $proj = projectes::where($opc)->get();
    return view('home',['projs' => $proj,
                        'mod' => true]);
})->name('projmod');

Route::get('projmodify/{id}', function($id) {
    $proj = projectes::find($id);
    return view('projectCreate',['proj' => $proj]);
})->name('projmodify');

Route::get('valid/{id}', function($id) {
    $proj = projectes::find($id);
    $proj->estat = 'Obert';
    $proj->save();
    return back();
})->name('valid');

Route::get('validate', 'ProjectesController@vali')->name('validate');
//operacions
Route::get('getops/{id}','AjaxController@index');
Route::get('getopsus/{id}','AjaxController@indexus');
//---

// Por si lo necesito
Route::middleware('auth:api')
    ->get('/user', function (Request $request) {
        return $request->user();
    });


