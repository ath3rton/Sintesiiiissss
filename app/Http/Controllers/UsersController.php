<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\userinfo;
use Illuminate\Support\Str;


class UsersController extends Controller
{
    public function index()
    {
        return Users::all();
    }

    public function show(Users $user)
    {
        return $user;
    }

    public function store(Request $request)
    {
        $user = Users::create($request->all());

        // Aquests json son per retornar l'estat HTTP 
        return response()->json($user, 201);
    }

    public function update(Request $request, Users $user)
    {
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function delete(Users $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
    public function visitor(Request $request)
    {
        $user = Users::create(['user_mail' => Str::random(32),
                               'user_password' => Str::random(32),
                               'rol' => 3]);
        $uinf = userinfo::create(
            ['first_name' => Str::random(32),
             'last_name' => Str::random(32),
             'nickname' => $request->get('nickname'),
             'dni' => Str::random(32),
             'usuari' => $user->id]
        );
        session()->put('user', $user);
        session()->put('uinf', $uinf);
        return redirect()->route('/');
    }
}
