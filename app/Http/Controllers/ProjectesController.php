<?php

namespace App\Http\Controllers;
use App\projectes;
use Illuminate\Http\Request;

class ProjectesController extends Controller
{
    public function index()
    {
        return projectes::all();
    }

    public function vali()
    {
        return view('validateView',['projs' =>projectes::where(['estat'=>'Creat'])->get()]);
    }

    public function show(projectes $proj)
    {
        return $proj;
    }

    public function store(Request $request)
    {
    //     $val = Request::validate([
    //         'user_mail'=>'required|string',
    //         'user_password' => 'required|string'
    //    ]);
        $proj = projectes::create($request->all());
        // Aquests json son per retornar l'estat HTTP
        return redirect()->route('/');
    }

    public function update(Request $request,projectes $proj)
    {
        $proj->update($request->all());
        return back();
    }

    public function delete($proj)
    {
        $proj = projectes::find($proj);
        $proj->actiu = 0;
        $proj->save();
        return back();
    }
}
