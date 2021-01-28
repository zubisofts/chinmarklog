<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
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

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $responseArray = [];
            $responseArray['token'] = $user->createToken('auth_user')->accessToken;
            $responseArray['user'] = $user;
            return response()->json($responseArray, 200);
        }else{
            return response()->json(['error' =>'unauthenticated'], 200);
        }
    }

    // API Authenticated and Guarded Routes Starts Here.
    public function checkUsers(Request $request)
    {
        if($request->user()->tokens()){
            return response()->json(['current_user'=>$request->user(), 'token' => $request->user()->token()], 200); 
        }else{
            return response()->json(['result'=>'No Token found'], 200);
        }
    }

    public function logout(Request $request)
    {
        if($request->user()->tokens()->delete()){
            return response()->json(['result'=>'Logout Successfull'], 200);
        }else{
            return response()->json(['result' => 'An unexpected error occured!'], 200);
        }
    }
}
