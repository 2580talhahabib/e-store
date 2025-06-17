<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
    public function authlogin(Request $req){
             $req->validate([
            'email'=>'required|string|email',
            'password'=>'required|string',
         ]);
        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password])){
            if(Auth::user()->is_verified == 0){
                Auth::logout();
                return back()->with('danger','Username & Password is Incorrect');
            }else{
                 if(Auth::user()->is_admin == 1){
                return redirect()->route('admin.dashboard')->with('success','Admin login successfully');
            }else{
                return redirect()->route('user.dashboard')->with('success','User login successfully');
                
            }
            }
           
        }else{
              return back()->with('danger','Username & Password is Incorrect');
        }

    }
    public function forgotpassword(){
        return view('frontant.Auth.forgotpassword');
    }
    public function authpassword(Request $req){
        $user=User::where('email',$req->email)->first();
        if(!$user){
            return back()->with('danger','Email Not Found');
        }
        $token=Str::random(40);
      $url = url('/restepassword/'.$token);
        PasswordReset::updateOrInsert(
            [
                'email'=>$user->email,
            ],
            [
                'email'=>$user->email,
                'token'=>$token,
                'created_at'=>Carbon::now(),
            ]
            );
            
        Mail::send('mails.password', ['url'=>$url], function ($message) use($user) {
          $message->to($user->email);
          $message->subject('Reset Password');
        });
        return back()->with('success','please check your email');
    }
    public function restepassword($token){
       $resetData = PasswordReset::where('token', $token)->first();
        if(!$resetData){
            return back()->with('danger','something went wronge');
        }
        $user= User::where('email',$resetData->email)->first();
        return view('frontant.Auth.resetpassword',compact('user'));
}
    public function authrestepassword(Request $req){
        $req->validate([
            'id'=>'required',
            'password'=>'required|confirmed',
        ]);
        $user=User::find($req->id);
        $user->password=Hash::make($req->password);
        $user->save();
        PasswordReset::where('email',$user->email)->delete();
        return redirect()->route('passwordupdated');
    }
    public function passwordupdated(){
        return view('frontant.Auth.password-updated');
    }
}