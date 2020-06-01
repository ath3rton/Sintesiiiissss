<?php


namespace App\Http\Controllers;
use Hash;
use Request;
use App\Users;
use App\userinfo;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $val = Request::validate([
             'user_mail'=>'required|string',
             'user_password' => 'required|string'
        ]);
        $us = array(
            'user_mail'=>Request::get('user_mail')
        );
        $user = Users::where($us)->first();
        $uinf = userinfo::where(['usuari' => $user->id])->first();
        if($user){
            if(Hash::check(Request::get('user_password'), $user->user_password)){
                session()->put('user', $user);
                session()->put('uinf', $uinf);
                return redirect()->route('/');
            }
        }
        return redirect()->back()
            ->withErrors('user_mail', 'auth.failed')
            ->withInput(request(['user_mail']));
    }
}
