<?php

use App\Http\Controllers\Admin\AppController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\IndexController;
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

Route::get('/', function () {
    return view('welcome');
});


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
     Route::post('/updateappdata', [AppController::class, 'updateappdata'])->name('admin.updateappdata');
     

});