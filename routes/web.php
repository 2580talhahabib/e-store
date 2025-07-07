<?php

use App\Http\Controllers\Admin\AppController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MainController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// MainController 
Route::get('/', [MainController::class, 'index'])->name('index');


// Frontant Route 

Route::middleware(['IsAuthenticated'])->group(function () {
  Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/authregister',[AuthController::class,'authregister'])->name('authregister');
Route::get('/verify/{user}',[VerificationController::class,'verify'])->name('verify');

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/authlogin',[AuthController::class,'authlogin'])->name('authlogin');
Route::get('/forgotpassword',[AuthController::class,'forgotpassword'])->name('forgotpassword');
Route::post('/authpassword',[AuthController::class,'authpassword'])->name('authpassword');

Route::get('/restepassword/{token}',[AuthController::class,'restepassword'])->name('restepassword');
Route::post('/authrestepassword',[AuthController::class,'authrestepassword'])->name('authrestepassword');
Route::get('/password-updated',[AuthController::class,'passwordupdated'])->name('passwordupdated');
});

Route::middleware(['OnlyAuthenticated'])->group(function () {
   Route::get('/user/dashboard', function () {
     echo "User login";
})->name('user.dashboard');
});
Route::middleware(['OnlyAuthenticated','OnlyAdmin'])->group(function () {
  // app data route 
     Route::get('/admin/dashboard', [AppController::class, 'index'])->name('admin.dashboard');
     Route::post('/admin/updateappdata', [AppController::class, 'updateappdata'])->name('admin.updateappdata');
     
    //  Menu Controller 
    Route::get("/admin/menus",[MenuController::class , 'index'])->name('admin.menus');
    Route::post("/admin/menus/store",[MenuController::class , 'store'])->name('admin.menus.store');
    Route::post("/admin/menu/update/{id}",[MenuController::class , 'update'])->name('admin.menus.update');
    Route::Delete("/admin/menu/delete/{id}",[MenuController::class , 'destroy'])->name('admin.menus.delete');
    
     //  Category Controller 
    Route::get("/admin/category",[CategoryController::class ,'index'])->name('admin.category');
    Route::post("/admin/category/store",[CategoryController::class ,'store'])->name('admin.category.store');
    Route::post("/admin/category/update/{id}",[CategoryController::class ,'update'])->name('admin.category.update');
    Route::Delete("/admin/category/delete",[CategoryController::class ,'destroy'])->name('admin.category.delete');

      //  Banner Controller 
    Route::get("/admin/banner",[BannerController::class ,'index'])->name('admin.banner');
    Route::post("/admin/banner/store",[BannerController::class ,'store'])->name('admin.banner.store');
    Route::post("/admin/banner/update",[BannerController::class ,'update'])->name('admin.banner.update');
    Route::Delete("/admin/banner/delete",[BannerController::class ,'destroy'])->name('admin.banner.delete');

       //  Variation Controller 
    Route::get("/admin/variation",[VariationController::class ,'index'])->name('admin.variation');
    Route::post("/admin/variation/store",[VariationController::class ,'store'])->name('admin.variation.store');
    Route::post("/admin/valuestore/store",[VariationController::class ,'valuestore'])->name('admin.valuestore.store');
    Route::post("/admin/variation/update",[VariationController::class ,'update'])->name('admin.variation.update');
    Route::Delete("/admin/variation/delete",[VariationController::class ,'destroy'])->name('admin.variation.delete');
    Route::Delete("/admin/valdestroy/delete",[VariationController::class ,'valdestroy'])->name('admin.valdestroy.delete');


    
      //  Product Controller 
    Route::get("/admin/product",[ProductController::class ,'index'])->name('admin.product');
    Route::post("/admin/product/store",[ProductController::class ,'store'])->name('admin.product.store');
    Route::post("/admin/product/update",[ProductController::class ,'update'])->name('admin.product.update');
    Route::Delete("/admin/product/delete",[ProductController::class ,'destroy'])->name('admin.product.delete');

    // category change controller 
    Route::get("/product/childcategory/",[ProductController::class ,'childcategory'])->name('product.childcategory');
    

});