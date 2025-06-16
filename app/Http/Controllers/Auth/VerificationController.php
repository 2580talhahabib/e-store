<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VerificationController extends Controller
{
   public function verify($token){
    $user=User::where('verification_token',$token)->first();
    if(!$user){
        abort(404,'Something went wronge!');
    }
    if($user->token_expires_at < Carbon::now()){
        $msg='Verification token has expired.please request a new Verification email';
        return view('mails.Verification-message',compact('msg'));
    }
    $user->is_verified=1;
    $user->email_verified_at=Carbon::now();
    $user->verification_token=null;
    $user->token_expires_at=null;
    $user->save();
     $msg='Email Verified Successfully';
        return view('mails.Verification-message',compact('msg'));
   }
}