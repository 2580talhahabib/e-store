<?php

use App\Models\AppData;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Variation;

function test(){
    return "Helper is working well";
}
function getdata(){
    return AppData::get();
}
function getmanu($position){
    try {
       return Menu::with('children')->where('position',$position)
                  ->whereNull('parent_id')->orderby('id') // Only get parent menus
                  ->get();
                  
        return $menus;
    } catch (\Throwable $th) {
        return [];
    }
}
 function getcategories(){
    try {
       $categories=Category::with('parent')->whereNull('parent_id')->get();
       
       return $categories;
       
    } catch (\Throwable $th) {
        return [];
    }
   
}
if(!function_exists('getbanners')){
     function getbanners(){
    try {
       $banners=Banner::where('status',1)->get();
       return $banners;
    } catch (\Throwable $th) {
        return [];
    }
    }
}


    function getvariations(){
        try {
                  $variations=Variation::with('value')->get();
                  return $variations;
        } catch (\Throwable $th) {
           return [];
        }
    }