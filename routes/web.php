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
        ->join('operacions', 'projectes.id', '=', 'operacions.projecte')
        ->select('projectes.*',DB::raw('sum(operacions.quantitat) as quantitat'))
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
Route::post('claim', 'UsersController@claim')->name('claim');
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
//operacions
Route::get('getops/{id}','AjaxController@index');
Route::get('getopsus/{id}','AjaxController@indexus');
//---

// Por si lo necesito
Route::middleware('auth:api')
    ->get('/user', function (Request $request) {
        return $request->user();
    });


