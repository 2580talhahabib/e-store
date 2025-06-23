<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class MenuController extends Controller
{
    public function index(){
        $parents=Menu::get();
        return view('admin.menus',compact('parents'));
    }
 
    public function store(Request $req)
{
    $data = [
        'name' => $req->name,
        'url' => $req->url,
        'is_extenal' => $req->has('is_extenal'),
        'position' => $req->position,
        'parent_id' => $req->parent_id ,
];

$created = Menu::create($data);

if ($created) {
return response()->json([
'status' => true,
'message' => "Data Created",
'data' => $created
]);
} else {
return response()->json([
'status' => false,
'message' => "Data not created"
], 500);
}
}
public function destroy($id){
       $data=Menu::where('id',$id)->first();
       $deleteid=$data->delete();
    if (!empty($deleteid)) {
return response()->json([
'status' => true,
'message' => "Data Deleted successfully",
'data' => $deleteid
]);
} else {
return response()->json([
'status' => false,
'message' => "Data not found"
], 500);
}
}
public function update(Request $req,$id){

$updateid=Menu::find($id);
if(!empty($updateid)){
    $updateid->update([
        'name' => $req->name,
        'url' => $req->url,
         'is_extenal' => $req->has('is_extenal'),
         'position' => $req->position,
         'parent_id' => $req->parent_id ,
    ]);
    return response()->json([
'status' => true,
'message' => "Data Updated",
]);
}else{
    return response()->json([
'status' => false,
'message' => "Data not found"
], 500);
}
    

}
}