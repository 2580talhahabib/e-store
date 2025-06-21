<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppData;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(){
        $data=AppData::first();
        return view('admin.dashboard',compact('data'));
    }
    public function updateappdata(Request $req){
     
     $validated=$req->validate([
            'logo_first_text'=>'required',
            'logo_second_text'=>'required',
            'heading'=>'required',
            'location'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'site_name'=>'required',
            'fasebook'=> 'nullable',
            'twitter'=> 'nullable',
            'linkdin'=> 'nullable',
            'instagram'=> 'nullable',
            'youtube'=> 'nullable',
            'contact_touch_text'=> 'nullable',
        ]);
              if(isset($req->id)){
                AppData::where('id',$req->id)->update($validated);
                return back()->with('success','App data Updated Successfully');
              }else{
                AppData::create($validated);
                return back()->with('success','App data created Successfully');

              }
    }
    
}