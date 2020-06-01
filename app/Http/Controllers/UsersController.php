<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
