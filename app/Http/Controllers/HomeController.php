<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessage([
                'email' => ['Invalid login credentails']
            ]);
        }else{
            $token = $user->createToken('mobile_token')->accessToken;
            return json_encode([
                'user' => $user,
                'token' => $token
            ]);
        }
    }

    public function register(Request $request)
    {
        if(!User::where('email', $request->email)->orWhere('phone', $request->phone)->exists()){
            return User::create([
                'firstname' => $request->fname,
                'lastname' => $request->lname !='' ? $request->lname : null,
                'phone' => $request->phone,
                'email' => $request->email,
                'usertype' => '1',
                'password' => Hash::make('12345678'),
            ]);
        }else{
            throw ValidationException::withMessage([
                'email' => ['User already exist!']
            ]);
        }
    }
}
