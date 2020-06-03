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
}
