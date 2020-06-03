<?php

namespace App\Http\Controllers;
use DB; 
use App\operacions;
use Illuminate\Http\Request;

class InvestController extends Controller
{
    public function invest(Request $request){
        $op = DB::table('operacions')->insert(['quantitat' => $request->get('quantitat'),
                                                'user' => $request->get('user'),
                                                'projecte' => $request->get('projecte')]);
        return back();
    }
}
