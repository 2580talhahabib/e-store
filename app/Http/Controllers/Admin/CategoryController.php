<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        try {
        $categorys=Category::whereNull('parent_id')->paginate(10);
        $categories=Category::with('children')->paginate(10);
        // return $categories;
        return view('admin.categories',compact('categories','categorys'));
          
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>true,
                'error'=>$th->getMessage(),
            ]);
        }
    }
    public function store(Request $req){
        // try {
           $category= $req->validate([
                'name'=>'required',
            ]);
            $category=Category::create([
                'name'=>$req->name,
                'parent_id'=>$req->parent_id,
            ]);
            if($category){
                return response()->json([
                    'status'=>true,
                    'message'=>'Category Created Successfully',
                    'category'=>$category,
                ]);
            }else{
                  return response()->json([
                    'status'=>false,
                    'message'=>'Category did not created',
                    'category'=>[]
                ]);
            }
            
        // } catch (\Throwable $th) {
        //    abort(404,'Something went wronge');
        // }
    }
    public function destroy($id){
       $data=Category::where('id',$id)->first();
       $deleteid=$data->delete();
    if (!empty($deleteid)) {
return response()->json([
'status' => true,
'message' => "Category Deleted successfully",
'data' => $deleteid
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