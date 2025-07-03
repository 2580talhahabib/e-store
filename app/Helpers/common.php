<?php

use App\Models\AppData;
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