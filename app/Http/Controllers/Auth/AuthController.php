<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
 $user = new User();
$user->name = $req->name;
$user->email = $req->email;
$user->country_code = $req->country_code;
$user->phone_number = $req->phone_number;
$user->password = Hash::make($req->password);
$user->verification_token = Str::random(60);
$user->token_expires_at = Carbon::now()->addHour();
$user->save();
        $this->sendverificationmail($user);
// return redirect()->route('sendverificationmail', ['user' => $user->id])
//     ->with('success', 'You are registered successfully. Please check your email for verification.');
return back()->with('success','you are registered successfully.please check your email for verification');    
}
    protected function sendverificationmail($user){
      
 $verificationur=url('/verify/'.$user->verification_token);
  
 Mail::send('mails.verification',['name'=>$user->name,'url'=>$verificationur], function ($message) use($user) {
     $message->to('tsab10691@gmail.com');
     $message->subject('Email Verfication');
 });
       
    }
  
    public function login(){
        return view('frontant.Auth.login');
    }
}