<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
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
    // ADMIN DASHBOARD
    route::get('admin/dashboard',[AdminController::class,'dashboard']);
    
    // CATEGORY ROUTES
    route::get('admin/category',[CategoryController::class,'index']);
    route::get('admin/category/manageCategory',[CategoryController::class,'manageCategory']);
    route::get('admin/category/manageCategory/{id}',[CategoryController::class,'manageCategory']);
    route::get('admin/category/manageCategory/{id}/{status}',[CategoryController::class,'manageCategory']);
    route::post('admin/category/manageCategoryProcess',[CategoryController::class,'manageCategoryProcess'])->name('category.manage');
    route::get('admin/category/delete/{id}',[CategoryController::class,'deleteCategory']);

    // COUPON ROUTES
    route::get('admin/coupon',[CouponController::class,'index']);
    route::get('admin/coupon/manageCoupon',[CouponController::class,'manageCoupon']);
    route::get('admin/coupon/manageCoupon/{id}',[CouponController::class,'manageCoupon']);
    route::get('admin/coupon/manageCoupon/{id}/{status}',[CouponController::class,'manageCoupon']);
    route::post('admin/coupon/manageCoupon',[CouponController::class,'manageCouponProcess'])->name('coupon.manage');
    route::get('admin/coupon/delete/{id}',[CouponController::class,'deleteCoupon']);
    
    // LOGOUT FUNCTION
    Route::get('admin/logout', function () {
        session()->put('ADMIN_LOGIN');
        session()->put('ADMIN_ID');
        session()->flash('error', 'Sucessfully Logged Out..!');
        return redirect('admin');
    });
});


