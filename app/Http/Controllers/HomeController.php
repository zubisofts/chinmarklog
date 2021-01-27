<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

        $user = User::where('email', $request->email)->get();
        
        // if(!$user || !Hash::check($request->password, $user->password)){
            return $user;
        if(count($user) < 1 || !Hash::check($request->password, $user->password)){
            return json_encode([
                'status' => 'error',
                'code' => 'error',
                'message' => 'Invalid login credentials'
            ]);
            // return ValidationException::withMessages([
            //     'email' => ['Invalid login credentails']
            // ]);
        }else{
            return 'Hello';
            return $user;
            // return json_encode(['email' => ['Successful']]);
            $token = $user->createToken('Auth User')->accessToken;
            return json_encode([
                'user' => $user,
                'token' => $token
            ]);
        }
    }

    public function register(Request $request)
    {

        // return $request;
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
