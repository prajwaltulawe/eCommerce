<?php

// ADMIN ROUTES
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\BannerImagesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CoustomerController;
use Illuminate\Support\Facades\Route;

route::get('admin',[AdminController::class,'index']);
route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

// ADMIN ROUTES
route::group(['middleware'=>'adminAuth'], function(){
    // ADMIN DASHBOARD
    route::get('admin/dashboard',[AdminController::class,'dashboard']);
    
    // CATEGORY ROUTES
    route::get('admin/category',[CategoryController::class,'index']);
    route::get('admin/category/manageCategory',[CategoryController::class,'manageCategory']);
    route::get('admin/category/manageCategory/{id}',[CategoryController::class,'manageCategory']);
    route::get('admin/category/manageCategory/{id}/{status}',[CategoryController::class,'manageCategory']);
    route::get('admin/category/setHomeDisplayStatus/{id}/{status}',[CategoryController::class,'setHomeDisplayStatus']);
    route::post('admin/category/manageCategoryProcess',[CategoryController::class,'manageCategoryProcess'])->name('category.manage');
    route::get('admin/category/delete/{id}',[CategoryController::class,'deleteCategory']);

    // COUPON ROUTES
    route::get('admin/coupon',[CouponController::class,'index']);
    route::get('admin/coupon/manageCoupon',[CouponController::class,'manageCoupon']);
    route::get('admin/coupon/manageCoupon/{id}',[CouponController::class,'manageCoupon']);
    route::get('admin/coupon/manageCoupon/{id}/{status}',[CouponController::class,'manageCoupon']);
    route::post('admin/coupon/manageCoupon',[CouponController::class,'manageCouponProcess'])->name('coupon.manage');
    route::get('admin/coupon/delete/{id}',[CouponController::class,'deleteCoupon']);
    route::get('admin/coupon/manageCoupon/isOneTime/{id}/{status}',[CouponController::class,'editOneTimeStatus']);


    // BRAND ROUTES
    route::get('admin/brand',[BrandController::class,'index']);
    route::get('admin/brand/manageBrand',[BrandController::class,'manageBrand']);
    route::get('admin/brand/manageBrand/{id}',[BrandController::class,'manageBrand']);
    route::get('admin/brand/manageBrand/{id}/{status}',[BrandController::class,'manageBrand']);
    route::get('admin/brand/setHomeDisplayStatusBrand/{id}/{status}',[BrandController::class,'setHomeDisplayStatus']);
    route::post('admin/brand/manageBrand',[BrandController::class,'manageBrandProcess'])->name('brand.manage');
    route::get('admin/brand/delete/{id}',[BrandController::class,'deleteBrand']);

    // TAX ROUTES
    route::get('admin/tax',[TaxController::class,'index']);
    route::get('admin/tax/manageTax',[TaxController::class,'manageTax']);
    route::get('admin/tax/manageTax/{id}',[TaxController::class,'manageTax']);
    route::get('admin/tax/manageTax/{id}/{status}',[TaxController::class,'manageTax']);
    route::post('admin/tax/manageTax',[TaxController::class,'manageTaxProcess'])->name('tax.manage');
    route::get('admin/tax/delete/{id}',[TaxController::class,'deleteTax']);

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

    // PRODUCT ROUTES
    route::get('admin/product',[ProductController::class,'index']);
    route::get('admin/product/manageProduct',[ProductController::class,'manageProduct']);
    route::get('admin/product/manageProduct/{id}',[ProductController::class,'manageProduct']);
    route::get('admin/product/manageProduct/{id}/{status}',[ProductController::class,'manageProduct']);
    route::post('admin/product/manageProduct',[ProductController::class,'manageProductProcess'])->name('product.manage');
    route::get('admin/product/delete/{id}',[ProductController::class,'deleteProduct']);

    // PRODUCT IMAGES ROUTES
    route::get('admin/product/editProduct/deleteImage/{id}',[ProductController::class,'deleteProductImage']);

    // PRODUCT ATTRIBUTE ROUTES
    route::get('admin/product/editProduct/deleteAttr/{id}',[ProductController::class,'deleteProductAttr']);
    route::get('admin/product/manageProduct/isPromo/{id}/{status}',[ProductController::class,'editPromoStatus']);
    route::get('admin/product/manageProduct/isFeatured/{id}/{status}',[ProductController::class,'editFeaturedStatus']);
    route::get('admin/product/manageProduct/isDiscounted/{id}/{status}',[ProductController::class,'editDiscountStatus']);
    route::get('admin/product/manageProduct/isTrending/{id}/{status}',[ProductController::class,'editTrendingStatus']);

    // BANNER IMAGES ROUTES
    route::get('admin/bannerImages',[BannerImagesController::class,'index']);
    route::get('admin/bannerImages/managebannerImages',[BannerImagesController::class,'manageBannerImages']);
    route::get('admin/bannerImages/managebannerImages/{id}',[BannerImagesController::class,'manageBannerImages']);
    route::get('admin/bannerImages/managebannerImages/{id}/{status}',[BannerImagesController::class,'manageBannerImages']);
    route::post('admin/bannerImages/managebannerImages',[BannerImagesController::class,'manageBannerImagesProcess'])->name('bannerImages.manage');
    route::get('admin/bannerImages/delete/{id}',[BannerImagesController::class,'deleteBannerImage']);

    // COUSTOMER ROUTES
    route::get('admin/coustomer',[CoustomerController::class,'index']);
    route::get('admin/coustomer/manageCoustomerStatus/{id}/{status}',[CoustomerController::class,'editCoustomerStatus']);
    route::get('admin/coustomer/viewCoustomerStatus/{id}',[CoustomerController::class,'viewCoustomerStatus']);

    // LOGOUT FUNCTION
    Route::get('admin/logout', function () {
        session()->put('ADMIN_LOGIN');
        session()->put('ADMIN_ID');
        session()->flash('error', 'Sucessfully Logged Out..!');
        return redirect('admin');
    });
});

// FRONT ROUTES
use App\Http\Controllers\Front\FrontController;
route::get('/',[FrontController::class,'index']);
route::get('/product/{slug}',[FrontController::class,'prdouctDisplay']);
