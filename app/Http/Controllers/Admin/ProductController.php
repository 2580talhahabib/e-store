<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\Variation;
use App\Models\VariationValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Validator;

class ProductController extends Controller
{

    public function index(){
        try {
            return view('admin.products');
        } catch (\Throwable $th) {
            return abort(404,'Some thing went wronge');
        }
    }

    public function store(Request $req){
        // dd($req->all());
        $validator=FacadesValidator::make($req->all(),[
            'title'=>'required',
            'pkr_price'=>'required',
        ]);
        if($validator->passes()){        
             $product=   Product::create([
        'title'=>$req->title,
        'pkr_price'=>$req->pkr_price,
        'usd_price'=>$req->usd_price,
        'stock'=>$req->stock,
        'category_id'=>$req->category_id,
        'descripation'=>$req->descripation,
        'add_information'=>$req->add_information,
        'sku'=>$req->sku,
       ]);
         if(!empty($req->image)){
    foreach ($req->image as $image) {
            $ext=$image->getClientOriginalExtension();
    $imagename=time().uniqid().'.'.$ext;
    $updload=public_path('uploads/products');
    $image->move($updload,$imagename);
    $imagename='uploads/products/'.$imagename;

    ProductImage::create([
    'product_id'=>$product->id,
    'path'=>$imagename,
]);
    }
}
      if(!empty($req->variation)){
    foreach ($req->variation as $variations) {
     
$variation=Variation::find($variations);
$variationvalue=VariationValues::find($variations);
    ProductVariation::create([
    'product_id'=>$product->id,
    'variation_id'=>$variation,
    'variation_value_id'=>$variationvalue,
]);
    }


}
       return response()->json([
        'status'=>true,
        'message'=>'product Added Successfully',
        'product'=>$product,
       ]);
        }
   
    }
    public function childcategory(Request $req){
   $category=Category::where('parent_id',$req->id)->get();
//    return $category;
if(!empty($category))
{
    return response()->json([
        'status'=>true,
        'message'=>'category found',
         'category'=>$category,
    ]);
}else{
        return response()->json([
        'status'=>false,
        'message'=>'category did not found',
         'category'=>[],
    ]);
}
}
}