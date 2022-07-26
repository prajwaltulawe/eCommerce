<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
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

    // SIZE ROUTES
    route::get('admin/size',[SizeController::class,'index']);
    route::get('admin/size/manageSize',[SizeController::class,'manageSize']);
    route::get('admin/size/manageSize/{id}',[SizeController::class,'manageSize']);
    route::get('admin/size/manageSize/{id}/{status}',[SizeController::class,'manageSize']);
    route::post('admin/size/manageSize',[SizeController::class,'manageSizeProcess'])->name('size.manage');
    route::get('admin/size/delete/{id}',[SizeController::class,'deleteSize']);
    
    // COLOR ROUTES
    route::get('admin/color',[ColorController::class,'index']);
    route::get('admin/color/manageColor',[ColorController::class,'manageColor']);
    route::get('admin/color/manageColor/{id}',[ColorController::class,'manageColor']);
    route::get('admin/color/manageColor/{id}/{status}',[ColorController::class,'manageColor']);
    route::post('admin/color/manageColor',[ColorController::class,'manageColorProcess'])->name('color.manage');
    route::get('admin/color/delete/{id}',[ColorController::class,'deleteColor']);
    
    // LOGOUT FUNCTION
    Route::get('admin/logout', function () {
        session()->put('ADMIN_LOGIN');
        session()->put('ADMIN_ID');
        session()->flash('error', 'Sucessfully Logged Out..!');
        return redirect('admin');
    });
});


