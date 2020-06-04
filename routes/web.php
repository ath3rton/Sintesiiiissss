<?php

use Illuminate\Support\Facades\Route;
Use App\Users;
Use App\projectes;
Use App\empreses;
Use App\userinfo;
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
    return back();
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
    // LA ABERRACION BUGEADA
    $projs = DB::table('projectes')
        ->leftjoin('operacions', 'projectes.id', '=', 'operacions.projecte')
        ->select('projectes.*',DB::raw('sum(operacions.quantitat) as quantitat'))
        ->where($pro)
        ->groupBy('operacions.projecte')
        ->groupBy('projectes.id')
        ->groupBy('projectes.nom_projecte')
        ->groupBy('projectes.descripcio')
        ->groupBy('projectes.feedback')
        ->groupBy('projectes.objectiu')
        ->groupBy('projectes.fraccio')
        ->groupBy('projectes.estat')
        ->groupBy('projectes.actiu')
        ->groupBy('projectes.emp_id')
        ->groupBy('projectes.created_at')
        ->groupBy('projectes.updated_at')
        ->groupBy('projectes.img')
        ->paginate(15);

    // bug tambien ...
    // $projs = DB::select(DB::raw("  SELECT projectes.* ,sum(operacions.quantitat) 
    //                                 FROM projectes 
    //                                 inner JOIN operacions on operacions.projecte = projectes.id 
    //                                 GROUP BY projecte"))
    //                             ->paginate(15);

    return view('home',['projs' => $projs,
                        'mod' => false ]);
})->name('/');

Route::get('/home', 'HomeController@index')->name('home');

// Login forms
Route::get('welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('log',function () {
    session()->forget('user');
    session()->forget('uinf');
    return view('welcome');
})->name('log');

Route::get('myemps',function () {
    $emps =  empreses::where(['owner' => session()->get('user')->id])->paginate(15);
    
    return view('empsView',['emps' =>$emps,
                            'mod' => false]);
})->name('myemps');

Route::post('registre', [ 'as' => 'registre', 'uses' =>'Auth\RegistreController@registre']);

// logout
Route::get('logout',function () {
    session()->forget('user');
    session()->forget('uinf');
    return redirect()->route('/');
})->name('logout');

// CRUD Usuaris
Route::get('allusers',function(){
    $us = Users::all();
    return view('userView',['users' => $us]);
})->name('allusers');

Route::get('bloqueja/{id}','UsersController@block')->name('bloqueja');
Route::get('desbloqueja/{id}','UsersController@unlock')->name('desbloqueja');

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

Route::get('claim/{id}', function($id){
    $us = userinfo::find($id);
    return view('claimUser',['user' => $us]);
})->name('claim');
//---
// EMPRESA
Route::get('empcreate', function() {
    return view('empcView', ['mod' => false]);
})->name('empcreate');

Route::get('modemp/{id}', function($id) {
    $emp = empreses::find($id);
    return view('empcView',['mod' => $emp]);
})->name('modemp');

Route::post('empresa', 'EmpresaController@update')->name('empresamod');
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
    $emps = empreses::where(['owner' => session()->get('user')->id])->get();
    return view('projectCreate',['proj' => null,
                                 'emps' => $emps]);
})->name('projcreate');

Route::get('projmod', function() {
    $opc = ['emp_id' => session()->get('user')->id,
            'actiu' => 1];
    $proj = projectes::where($opc)->paginate(15);
    return view('home',['projs' => $proj,
                        'mod' => true]);
})->name('projmod');

Route::get('projmodify/{id}', function($id) {
    $proj = projectes::find($id);
    return view('projectCreate',['proj' => $proj,
                                 'emps' => null]);
})->name('projmodify');

Route::get('valid/{id}', function($id) {
    $proj = projectes::find($id);
    $proj->estat = 'Obert';
    $proj->save();
    return back();
})->name('valid');

Route::get('validate', 'ProjectesController@vali')->name('validate');

Route::post('denuncia', 'ProjectesController@denuncia')->name('denuncia');

Route::get('denuncias', 'ProjectesController@getdenuncies')->name('denuncias');

Route::get('unlock/{id}', 'ProjectesController@unlock')->name('unlock');

Route::get('projdenuncias/{id}', 'ProjectesController@projdenuncias')->name('projdenuncias');

//operacions
Route::get('getops/{id}','AjaxController@index');
Route::get('getopsus/{id}','AjaxController@indexus');

Route::get('invertir/{id}','InvestController@invest')->name('invertir');
//---

// Por si lo necesito
Route::middleware('auth:api')
    ->get('/user', function (Request $request) {
        return $request->user();
    });


// importacion exportacion

Route::get('export',function(){
    return view('exportView');
})->name('export');
Route::get('import',function(){
    return view('importView');
})->name('import');
// EXPORTS
Route::get('userexport','ExpImpController@userexport')->name('userexport');
Route::get('projectexport','ExpImpController@projectexport')->name('projectexport');
Route::get('companyexport','ExpImpController@companyexport')->name('companyexport');
Route::get('opsexport','ExpImpController@opsexport')->name('opsexport');

// IMPORTS

Route::post('useri','ExpImpController@userimport')->name('useri');
Route::post('projecti','ExpImpController@projectimport')->name('projecti');
Route::post('companyi','ExpImpController@companyimport')->name('companyi');
Route::post('opsi','ExpImpController@opsimport')->name('opsi');
