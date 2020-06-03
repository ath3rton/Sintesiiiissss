<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Request;
use App\Users;
use App\userinfo;

class RegistreController extends Controller
{
    public function registre(Request $request)
    {
        $valor = Request::validate([
             'user_mail'=>'required|string',
             'user_password' => [   'required',
                                    'string',
                                    'min:10',             
                                    'regex:/[a-z]/',    
                                    'regex:/[0-9]/',      
                                    'regex:/[@$!%*#?&]/',
                                    'required_with:repassword',
                                    'same:repassword',
                                ],
             'repassword' => 'required',
             'fname' => 'required|string',
             'lname' => 'string',
             'dni' => 'required|string'
        ]);
        $us = array(
            'user_mail'=>Request::get('user_mail')
        );
        $us = Users::where($us)->first();
        
        if($us){
            return redirect()->back()
                ->withErrors('user_mail', 'auth.error')
                ->withInput(request(['user_mail']))
                ->withInput(request(['fname']))
                ->withInput(request(['lname']))
                ->withInput(request(['dni']));
        }
        $user = Users::create([
            'user_mail' => Request::get('user_mail'),
            'user_password' => Hash::make(Request::get('user_password')),
            'rol' =>2
        ]);
        $us = array(
            'user_mail'=> Request::get('user_mail')
        );
        $us = Users::where($us)->first();
        $uinf =  userinfo::create([
            'first_name' => Request::get('fname'),
            'last_name' => Request::get('lname'),
            'nickname' => Request::get('fname'),
            'dni' => Request::get('dni'),
            'usuari' => $us->id
        ]);
        session()->put('user', $us);
        session()->put('uinf',$uinf);
        return redirect()->route('/');
    }
}

        

