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
                    ->leftJoin('sizes','sizes.id',"=","productattr.size") 
                    ->where(['productattr.productId'=>$productList->id])
                    ->get();
            }
        }

/*         foreach ($result['homeCategoriesProducts'] as $list) {
            $result['homeCategoriesProductsAttr'][$list->id] = 
                DB::table('productattr')
                    ->leftJoin('sizes','sizes.id',"=","productattr.size") 
                    ->leftJoin('sizes','sizes.id',"=","productattr.size") 
                    ->where(['productattr.productId'=>$list->id])
                    ->get();
        }
 */
        // echo '<pre>';
        // print_r($result);
        return view('front.index', $result);    
    }
}
