<?php

namespace App\Http\Controllers;
Use App\operacions;
Use App\Users;
Use App\userinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AjaxController extends Controller
{
    public function index($s) {
        $msg= operacions::where(['projecte' => $s])->get();
        return response()->json($msg);
    }
    public function indexus($s) {
        $msg= operacions::where(['projecte' => $s])->get();
        $all = array();
        foreach($msg as $ms){
            $u = userinfo::where(['usuari'=> $ms->user])->get()->first();
            array_push($all,['user' => $u,
                            'quant' => $ms->quantitat]);
        }
        return response()->json($all);
    }
}

