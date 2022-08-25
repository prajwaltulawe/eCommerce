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



        return view('front.index', $result);    
    }

    public function prdouctDisplay(Request $req, $slug)
    {          
        
        $result['productInfo'] = DB::table('products')
            ->where(['slug'=>$slug])
            ->get();

        foreach($result['productInfo'] as $list){
            $result['productsAttr'][$list->id] = 
            DB::table('productattr')
                ->leftJoin('sizes','sizes.id',"=","productattr.size") 
                ->leftJoin('colors','colors.id',"=","productattr.color") 
                ->where(['productattr.productId'=>$list->id])
                ->get();
        }

        $result['relatedProducts'] = DB::table('products')
            ->where(['categoryId'=>$result['productInfo'][0]->categoryId])
            ->where('slug','!=',$slug)
            ->get();

        foreach($result['relatedProducts'] as $list){
            $result['relatedProductsAttr'][$list->id] = 
            DB::table('productattr')
                ->leftJoin('sizes','sizes.id',"=","productattr.size") 
                ->leftJoin('colors','colors.id',"=","productattr.color") 
                ->where(['productattr.productId'=>$list->id])
                ->get();
        }

        $result['productImages'] = DB::table('productimages')
            ->where(['productId'=>$result['productInfo'][0]->id])
            ->get();

        return view('front.product', $result);
    }
    
    public function addToCart(Request $req)
    {     
        if ($req->session()->has('FRONT_USER_ID')) {
            $uid = $req->session()->get('FRONT_USER_ID');
            $userType = "Resgistered";
        } else {
            $uid = getUserTempId();
            $userType = "Non-Registered";    
        }

        $qty = $req->post('pqty');
        $productId = $req->post('productId');
        $sizeId = $req->post('selectedSizeId');
        $colorId = $req->post('selectedColorId');

        $result = DB::table('productattr')
            ->select('productattr.id')
            ->leftJoin('sizes','sizes.id',"=","productattr.size") 
            ->leftJoin('colors','colors.id',"=","productattr.color") 
            ->where(['productId'=>$productId])
            ->where(['sizes.size'=>$sizeId])
            ->where(['colors.color'=>$colorId])
            ->get();

        $productAttrId = $result[0]->id;
        
        $check = DB::table('cart')
            ->where(['userId'=>$uid])
            ->where(['userType'=>$userType])
            ->where(['prodId'=>$productId])
            ->where(['prodAttrId'=>$productAttrId])
            ->get();
        
        if (isset($check[0])) {
            $updateId = $check[0]->id;
            DB::table('cart')
                ->where(['id'=>$updateId])
                ->update(['qty'=>$qty]);
            $msg = "Updated";
        } else {
            $id = DB::table('cart')
                ->insertGetId([
                    'userId'=>$uid,
                    'userType'=>$userType,
                    'prodId'=>$productId,
                    'prodAttrId'=>$productAttrId,
                    'qty'=>$qty,
                ]);
            $msg = "Added";
        }

        return response()->json(['msg'=>$msg]);
        
    }
}
