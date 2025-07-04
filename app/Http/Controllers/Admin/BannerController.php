<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

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
       $data=Category::where('id',$req->id)->orWhere('parent_id',$req->id)->delete();
    if (!empty($data)) {
return response()->json([
'status' => true,
'message' => "Category Deleted successfully",
'data' => $data
]);
} else {
return response()->json([
'status' => false,
'message' => "Category not found"
], 500);
}
}
public function update(Request $req,$id){

$updateid=Category::find($id);
if(!empty($updateid)){
    $updateid->update([
        'name' => $req->name,
         'parent_id' => $req->parent_id ,
    ]);
    return response()->json([
'status' => true,
'message' => "Category Updated",
]);
}else{
    return response()->json([
'status' => false,
'message' => "Category not found"
], 500);
}
}
}