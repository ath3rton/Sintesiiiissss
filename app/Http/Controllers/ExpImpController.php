<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Users;
use App\projectes;
use App\empreses;
use App\operacions;
use File;

class ExpImpController extends Controller
{
    // EXPORT
    public function userexport(){
        $us = Users::all();
        $filename = "users.json";
        $handle = fopen($filename, 'w+');
        $headers = array('Content-type'=> 'application/json');
        fputs($handle,$us->toJson(JSON_PRETTY_PRINT));
        return response()->download($filename,$filename,$headers);
    }
    public function projectexport(){
        $us = projectes::all();
        $filename = "projects.json";
        $handle = fopen($filename, 'w+');
        $headers = array('Content-type'=> 'application/json');
        fputs($handle,$us->toJson(JSON_PRETTY_PRINT));
        return response()->download($filename,$filename,$headers);
    }
    public function companyexport(){
        $us = empreses::all();
        $filename = "empreses.json";
        $handle = fopen($filename, 'w+');
        $headers = array('Content-type'=> 'application/json');
        fputs($handle,$us->toJson(JSON_PRETTY_PRINT));
        return response()->download($filename,$filename,$headers);
    }
    public function opsexport(){
        $us = operacions::all();
        $filename = "operacions.json";
        $handle = fopen($filename, 'w+');
        $headers = array('Content-type'=> 'application/json');
        fputs($handle,$us->toJson(JSON_PRETTY_PRINT));
        return response()->download($filename,$filename,$headers);
    }
    // IMPORT
    public function userimport(Request $request){
        $filename= "userimport.json";
        $file = $request->file('userim');
        $file->move('userimport/',$filename);
        $content = File::get('userimport/'.$filename);
        $content = json_decode($content);
        for($i = 0 ; $i<count($content);$i++){
            Users::create(['user_mail' => $content[$i]->user_mail,
                            'user_password' =>$content[$i]->user_password,
                            'rol' => $content[$i]->rol]);
        }
           
        return back();
    }
    public function projectimport(Request $request){
        $filename= "projectimport.json";
        $file = $request->file('projectim');
        $file->move('projectimport/',$filename);
        $content = File::get('projectimport/'.$filename);
        $content = json_decode($content);
        for($i = 0 ; $i<count($content);$i++){
            projectes::create(['nom_projecte' => $content[$i]->nom_projecte,
                                'descripcio' => $content[$i]->descripcio,
                                'feedback' => $content[$i]->feedback,
                                'objectiu' => $content[$i]->objectiu,
                                'fraccio' => $content[$i]->fraccio,
                                'emp_id' => $content[$i]->emp_id,
                                'img' => $content[$i]->img]);
        }
           
        return back();
    }
    public function companyimport(Request $request){
        $filename= "companyimport.json";
        $filerout ="projectimport/";
        $file = $request->file('companyim');
        $file->move($filerout,$filename);
        $content = File::get($filerout.$filename);
        $content = json_decode($content);
        for($i = 0 ; $i<count($content);$i++){
            empreses::create(['nom_empresa'=> $content[$i]->nom_empresa,
                            'cif'=> $content[$i]->cif,
                            'ciutat'=> $content[$i]->ciutat,
                            'owner'=> $content[$i]->owner,
                            'logo'=> $content[$i]->logo,
                            'telf'=> $content[$i]->telf,
                            'web'=> $content[$i]->web]);
        }
           
        return back();
    }
    public function opsimport(Request $request){
        $filename= "operacionsimport.json";
        $filerout ="projectimport/";
        $file = $request->file('investim');
        $file->move($filerout,$filename);
        $content = File::get($filerout.$filename);
        $content = json_decode($content);
        for($i = 0 ; $i<count($content);$i++){
            operacions::create(['quantitat'=> $content[$i]->quantitat,
                            'user'=> $content[$i]->user,
                            'projecte'=> $content[$i]->projecte]);
        }
           
        return back();
    }
}
