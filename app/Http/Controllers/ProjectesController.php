<?php

namespace App\Http\Controllers;
use App\projectes;
use App\empreses;
use App\denuncies;
use App\operacions;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Str;

class ProjectesController extends Controller
{
    public function index()
    {
        return projectes::all();
    }
    public function unlock($id)
    {
        $proj = projectes::where(['id' => $id])->first();
        $proj->estat = 'Obert';
        $proj->save();
        return redirect()->route('denuncias');
    }
    public function getdenuncies()
    {
        
        $proj = projectes::where(['estat' => 'Bloquejat'])
                    ->paginate(15);

        return  view('denunciesView',['projs' =>$proj]);
    }

    public function projdenuncias($id)
    {    
        $proj = projectes::where(['id' => $id])->first();
        $dens = denuncies::where(['proj' => $id])->get();
        return  view('projdenunciesView',['proj' =>$proj,
                                          'denuncies' => $dens]);
    }

    public function vali()
    {
        return view('validateView',['projs' =>projectes::where(['estat'=>'Creat'])->get()]);
    }

    public function show(projectes $proj)
    {
        return $proj;
    }
    public function denuncia(Request $request)
    {
        $denun = new denuncies;
        $denun->descripcio = $request->get('descripcio');
        $denun->proj = $request->get('proj');
        $denun->usuari = $request->get('usuari');
        $denun->save();
        $proj = projectes::where(['id' => $request->get('proj')])->first();
        $proj->estat = 'Bloquejat';
        $proj->save();
        return redirect()->route('/');
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
            $destinationPath = 'images/proj_images/';
            $file->move($destinationPath, $hash);
        }
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
