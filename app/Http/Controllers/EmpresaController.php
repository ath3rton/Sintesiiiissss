<?php

namespace App\Http\Controllers;
use App\empreses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class EmpresaController extends Controller
{
    public function store(Request $request)
    {   
        $file = $request->file('logo');
        var_dump($file);
        $hash = null;
        if($file){
            $hash = Str::random(32).".".$file->getClientOriginalExtension();
            $destinationPath = 'images/emp_logos/';
            $file->move($destinationPath, $hash);
        }
        $replaced = array_replace($request->all(), ['logo' => $hash]);
        var_dump($replaced);
        $replaced = empreses::create($replaced);
        return redirect()->route('/');
        // return response()->json($user, 201);
    }
    public function update(Request $request)
    {
        $emp = empreses::where(['owner' => $request->get('owner')])->first();
       
        $file = $request->file('logo');
        $filelast = $request->file('logolast');
        $hash = null;
        
        if(!$filelast && $file){
            $hash = Str::random(32).".".$file->getClientOriginalExtension();
            $destinationPath = 'images/emp_logos/';
            $file->move($destinationPath, $hash);
            $emp->logo =$hash;
        }
        $emp->nom_empresa = $request->get('nom_empresa');
        $emp->cif = $request->get('cif');
        $emp->ciutat =$request->get('ciutat');
        $emp->telf = $request->get('telf');
        $emp->web = $request->get('web');
        $emp->save();
        return redirect()->route('myemps');
    }
}
