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
        $proj = projectes::create($request->all());
        // Aquests json son per retornar l'estat HTTP
        return redirect()->route('/');
    }

    public function update(Request $request,projectes $proj)
    {
        $proj->update($request->all());
        return back();
    }

    public function delete(projectes $proj)
    {
        $proj->delete();
        return back();
    }
}
