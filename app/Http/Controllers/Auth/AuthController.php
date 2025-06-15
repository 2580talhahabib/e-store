<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
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
   $user=User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'country_code'=>$req->country_code,
            'phone_number'=>$req->phone_number,
            'password'=>Hash::make($req->password),
            'verification_token'=>Str::random(60),
            'token_expires_at'=>Carbon::now()->addHour(),
        ]);
        $this->sendverificationmail($user);
return redirect()->route('sendverificationmail', ['token' => $user->verification_token])
    ->with('success', 'You are registered successfully. Please check your email for verification.');    }
    protected function sendverificationmail($user){

        $to='tsab10691@gmail.com';
        $msg=$user;
        $subject='Verfication Email';
        Mail::to($to)->send(new VerificationEmail($msg,$subject));
        
        // $verificationurl=url('/verify'.$user->verification_token);
        // Mail::send('mails.verification',['name'=>$user->name,'url'=>$verificationurl],function($message) use($user){
        //     $message->to($user->email);
        //     $message->subject('Email Verification');
        // });
    }
    //     public function SendEmail(){
    //     $to='tsab10691@gmail.com';
    //     $msg="Dumy text";
    //     $subject="Talha Habib";
        
    // Mail::to($to)->send(new VerificationEmail($msg,$subject));

    // }
    public function login(){
        return view('frontant.Auth.login');
    }
}