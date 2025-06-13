<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
       return view('frontant.Auth.register');
    }
    public function authregister(Request $req){
         $req->validate([
            'name'=>'required|string|min:2',
            'email'=>'required|string|email|unique:users',
            'phone_number'=>'required|numeric',
            'password'=>'required|string|confirmed',

         ]);
        User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'country_code'=>$req->country_code,
            'phone_number'=>$req->phone_number,
            'password'=>Hash::make($req->password),
        ]);
        // return redirect
    }
}