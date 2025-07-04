<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index(){
        try {
        $banners=Banner::paginate(10);
        return view('admin.banners',compact('banners'));
          
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>true,
                'error'=>$th->getMessage(),
            ]);
        }
    }
    public function store(Request $req){
        // dd($req->all());
        // try {
            $req->validate([
                'image'=>'required|image',
                'heading'=>'required',
            ]);
            $filename="";
            if($req->has('image')){
                $image = $req->file('image');
                $ext=$image->getClientOriginalExtension();
                $filename=time().".".$ext;
                $updload=public_path('uploads/banners');
                $image->move($updload,$filename);
                $filename='uploads/banners/'.$filename;
            }
            $banner=Banner::create([
                'image'=>$filename,
                'paragraph'=>$req->paragraph,
                'heading'=>$req->heading,
                'btn_text'=>$req->btn_text,
                'link'=>$req->link,
                'status'=>$req->status,
            ]);
            if($banner){
                return response()->json([
                    'status'=>true,
                    'message'=>'Banner Created Successfully',
                    'banner'=>$banner,
                ]);
            }else{
                  return response()->json([
                    'status'=>false,
                    'message'=>'Banner did not created',
                    'banner'=>[]
                ]);
            }
            
        // } catch (\Throwable $th) {
        //    abort(404,'Something went wronge');
        // }
    }
    public function destroy(Request $req){    
        // dd($req->all());
       $banner=Banner::where('id',$req->id)->first();
        if($banner->image){
                File::delete($banner->image);
            }
       $banner->delete();
      
    if (!empty($banner)) {
return response()->json([
'status' => true,
'message' => "Banner Deleted successfully",
'data' => $banner,
]);
} else {
return response()->json([
'status' => false,
'message' => "Banner not found"
], 500);
}
}
public function update(Request $req){
// dd($req->all());
   $filename="";
        $update=Banner::find($req->id);
         if($req->has('image')){
             if($update->image && file_exists(public_path($update->image))) {
           unlink($update->image) ;
        }
// dd($update);
        if($req->has('image')){
                $image = $req->file('image');
                $ext=$image->getClientOriginalExtension();
                $filename=time().".".$ext;
                $updload=public_path('uploads/banners');
                $image->move($updload,$filename);
                $filename='uploads/banners/'.$filename;
            }
  $updatedata=  $update->update([
                'image'=>$filename,
                'paragraph'=>$req->paragraph,
                'heading'=>$req->heading,
                'btn_text'=>$req->btn_text,
                'link'=>$req->link,
                'status'=>$req->status,
        ]);
    
        

if(!empty($updatedata)){
   
    return response()->json([
'status' => true,
'message' => "Banner Updated successfully",
'banner'=>$updatedata,
]);
}else{
    return response()->json([
'status' => false,
'message' => "Banner not found"
], 500);
}
}
}
}