<?php

use App\Models\AppData;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Menu;

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
 function getbanners(){
    try {
       $banners=Banner::where('status',1)->get();
       return $banners;
    } catch (\Throwable $th) {
        return [];
    }
    }