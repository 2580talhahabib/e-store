<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variation;
use App\Models\VariationValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VariationController extends Controller
{
    public function index(){
        try {
        $variations=Variation::with('value')->paginate(10);
    // return $variations;
        return view('admin.variation',compact('variations'));
          
        } catch (\Throwable $th) {
           return abort(404,'Some thing went wronge');
        }
    }
    public function store(Request $req){
        // dd($req->all());
        // try {
        $validator=Validator::make($req->all(),[
                            'name'=>'required|unique:variations'
        ]);

        if($validator->passes()){
            Variation::create([
                'name'=>strtolower($req->name),
            ]); 
              return response()->json([
                    'status'=>true,
                    'message'=>'Variation Created Successfully',
                    'variation'=>$validator,
                ]);
        }else{
                return response()->json([
                    'status'=>false,
                     'error'=>$validator->errors(),
                ]);
        }
    }
      public function valuestore(Request $req){
        // dd($req->all());
        // try {
        $validator=Validator::make($req->all(),[
            'variation_id'=>'required',
            'value'=>'required|unique:variation_values'
        ]);

        if($validator->passes()){
            VariationValues::create([
                'variation_id'=>$req->variation_id,
                'value'=>strtolower($req->value),
            ]); 
              return response()->json([
                    'status'=>true,
                    'message'=>'Value  Created Successfully',
                    'variation'=>$validator,
                ]);
        }else{
                return response()->json([
                    'status'=>false,
                     'error'=>$validator->errors(),
                ]);
        }
    }
    public function valdestroy(Request $req){
        $variationvalue=VariationValues::where('id',$req->id)->delete();
       return response()->json([
        'status'=>true,
        'message'=>'Variation Value deleted successfully'
       ]);
       
    }
    public function destroy(Request $req){    
        // dd($req->all());
       $variations=Variation::where('id',$req->delete_variation_id)->first();
       
       $variations->delete();
      
    if (!empty($variations)) {
return response()->json([
'status' => true,
'message' => "Variation Deleted successfully",
'data' => $variations,
]);
} else {
return response()->json([
'status' => false,
'message' => "variations not found"
], 500);
}
}
public function update(Request $req){
// dd($req->all());
 
        $update=Variation::find($req->id);
        
// dd($update);
       
  $updatedata=  $update->update([
           'name'=>$req->name,
        ]);
    
        

if(!empty($updatedata)){
   
    return response()->json([
'status' => true,
'message' => "Vairation Updated successfully",
'banner'=>$updatedata,
]);
}else{
    return response()->json([
'status' => false,
'message' => "Variation not found"
], 500);
}
}

}