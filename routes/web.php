<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

route::get('admin',[AdminController::class,'index']);
route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

route::group(['middleware'=>'adminAuth'], function(){
    route::get('admin/dashboard',[AdminController::class,'dashboard']);
    route::get('admin/category',[CategoryController::class,'index']);
    route::get('admin/manageCategory',[CategoryController::class,'manageCategory']);
    Route::get('admin/logout', function () {
        session()->put('ADMIN_LOGIN');
        session()->put('ADMIN_ID');
        session()->flash('error', 'Sucessfully Logged Out..!');
        return redirect('admin');
    });
});
