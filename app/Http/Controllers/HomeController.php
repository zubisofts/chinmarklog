<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        return json_encode([
            'status'=>'success',
            'msg' => 'Hello world',
            'data'=>$request
        ]);
    }
}
