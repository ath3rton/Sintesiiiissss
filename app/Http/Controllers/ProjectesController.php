<?php

namespace App\Http\Controllers;
use App\projectes;
use App\empreses;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Str;

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
        $val = $request->validate([
            'nom_projecte'=>'required|string',
            'img' => 'mimes:jpeg,bmp,png',
            'objectiu' =>['required','numeric', 'min:1','max:99999999.999', 'regex:/^\d+(\.\d{1,2})?$/'],
            'fraccio' => ['required','numeric', 'min:1','max:99999999.999', 'regex:/^\d+(\.\d{1,2})?$/'],
            'descripcio' => 'required|string',
            'feedback' => 'required|string'
        ]);
        $file = $request->file('img','emp_id');
        $hash = null;
        if($file){
            $hash = Str::random(32).".".$file->getClientOriginalExtension();
            $destinationPath = 'images/emp_images/';
            $file->move($destinationPath, $hash);
        }
        var_dump($request->all());
        $replaced = array_replace($request->all(), ['img' => $hash]);
        $proj = projectes::create($replaced);
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
