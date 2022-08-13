<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(Request $req)
    {    
        $result['homeCategories'] = DB::table('categories')
            ->where(['categoryStatus'=>1])
            ->where(['isHome'=>1])->get();

        foreach ($result['homeCategories'] as $list) {
            $result['homeCategoriesProducts'][$list->id] = 
                DB::table('products') 
                    ->where(['status'=>1])
                    ->where(['categoryId'=>$list->id])
                    ->get();

            foreach($result['homeCategoriesProducts'][$list->id] as $productList){
                $result['homeCategoriesProductsAttr'][$productList->id] = 
                DB::table('productattr')
                    ->leftJoin('sizes','sizes.id',"=","productattr.size") 
                    ->leftJoin('colors','colors.id',"=","productattr.color") 
                    ->where(['productattr.productId'=>$productList->id])
                    ->get();
            }
        }

        $result['homeBrands'] = 
            DB::table('brands')
            ->where(['ishome'=>1])
            ->where(['status'=>1])
            ->get();
        
        $result['featured'] = DB::table('products')
        ->where(['status'=>1])
        ->where(['isFeatured'=>1])->get();

        foreach ($result['featured'] as $list) {
            $result['homeFeaturedProductsAttr'][$list->id] = 
                DB::table('productattr')
                ->leftJoin('sizes','sizes.id',"=","productattr.size") 
                ->leftJoin('colors','colors.id',"=","productattr.color") 
                ->where(['productattr.productId'=>$list->id])
                ->get();

        }

        $result['trending'] = DB::table('products')
        ->where(['status'=>1])
        ->where(['isTrending'=>1])->get();

        foreach ($result['trending'] as $list) {
            $result['homeTrendingProductsAttr'][$list->id] = 
                DB::table('productattr')
                ->leftJoin('sizes','sizes.id',"=","productattr.size") 
                ->leftJoin('colors','colors.id',"=","productattr.color") 
                ->where(['productattr.productId'=>$list->id])
                ->get();

        }

        $result['discounted'] = DB::table('products')
        ->where(['status'=>1])
        ->where(['isDiscounted'=>1])->get();

        foreach ($result['featured'] as $list) {
            $result['homeDiscountedProductsAttr'][$list->id] = 
                DB::table('productattr')
                ->leftJoin('sizes','sizes.id',"=","productattr.size") 
                ->leftJoin('colors','colors.id',"=","productattr.color") 
                ->where(['productattr.productId'=>$list->id])
                ->get();

        }

        $result['bannerImages'] = DB::table('banner_images')
        ->where(['status'=>1])->get();

/*      echo '<pre>';
        print_r($result);
        die();  */

        return view('front.index', $result);    
    }
}
