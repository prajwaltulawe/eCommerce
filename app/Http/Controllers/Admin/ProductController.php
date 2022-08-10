<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\category;
use App\Models\Admin\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $result['data'] = product::all();
        return view('admin/product',$result);
    }

    public function manageProduct($id = '', $status = '')
    {
        if ($id > 0 && $status != '') {
            $model = product::find($id);   
            $model->status = $status;
            $model->save();
            return redirect('admin/product');
        }
        elseif ($id > 0) {
            $arr= product::where(['id'=>$id])->get();
            
            $result['id'] = $arr['0']->id;
            $result['categoryId'] = $arr['0']->categoryId;
            $result['image'] = $arr['0']->image;
            $result['name'] = $arr['0']->name;
            $result['slug'] = $arr['0']->slug;
            $result['brand'] = $arr['0']->brand;
            $result['model'] = $arr['0']->model;
            $result['shortDesc'] = $arr['0']->shortDesc;
            $result['desc'] = $arr['0']->desc;
            $result['keywords'] = $arr['0']->keywords;
            $result['technicalSpecs'] = $arr['0']->technicalSpecs;
            $result['uses'] = $arr['0']->uses;
            $result['warranty'] = $arr['0']->warranty;
            $result['leadTime'] = $arr['0']->leadTime;
            $result['tax'] = $arr['0']->tax;
            $result['taxType'] = $arr['0']->taxType;
            $result['isPromo'] = $arr['0']->isPromo;
            $result['isFeatured'] = $arr['0']->isFeatured;
            $result['isDiscounted'] = $arr['0']->isDiscounted;
            $result['isTrending'] = $arr['0']->isTrending;

            $result['prodAttr'] = DB::table('productattr')->where(['productId'=> $id])->get();
            $result['brands'] = DB::table('brands')->where(['id'=> $id])->get();
            $result['prodImages'] = DB::table('productimages')->where(['productId'=>$id])->get();
            $result['buttonStatus'] = "Edit Product"; 
        }
        else{
            $result['id'] = "";
            $result['categoryId'] = "";
            $result['image'] = "";
            $result['name'] = "";
            $result['slug'] = "";
            $result['brand'] = "";
            $result['model'] = "";
            $result['shortDesc'] = "";
            $result['desc'] = "";
            $result['keywords'] = "";
            $result['technicalSpecs'] = "";
            $result['uses'] = "";
            $result['warranty'] = "";
            $result['leadTime'] = "";
            $result['tax'] = "";
            $result['taxType'] = "";
            $result['isPromo'] = "";
            $result['isFeatured'] = "";
            $result['isDiscounted'] = "";
            $result['isTrending'] = "";

            $result['prodImages'][0]['image'] = "";
            $result['prodImages'][0]['id'] = "";
            $result['attrImage'] = "";

            $result['prodAttr'][0]['id'] = "";
            $result['prodAttr'][0]['sku'] = "";
            $result['prodAttr'][0]['mrp'] = "";
            $result['prodAttr'][0]['price'] = "";
            $result['prodAttr'][0]['qty'] = "";
            $result['prodAttr'][0]['size'] = "";
            $result['prodAttr'][0]['color'] = "";
            $result['prodAttr'][0]['attrImage'] = "";
            $result['buttonStatus'] = "Add Product"; 
        }

        $result['category'] = DB::table('categories')->where(['categoryStatus'=>1])->get();
        $result['brands'] = DB::table('brands')->where(['status'=>1])->get();
        $result['color'] = DB::table('colors')->where(['status'=>1])->get();
        $result['size'] = DB::table('sizes')->where(['status'=>1])->get();
        return view('admin.manageProduct', $result);
    }

    public function manageProductProcess(Request $req)
    {

        if ($req->post('id') > 0) {
            $imageValidation = 'mimes:jpeg,jpg,png';
        } else {
            $imageValidation = 'required|mimes:jpeg,jpg,png';
        }

        $req->validate([
            'name'=>'required',
            'slug'=>'required|unique:products,slug,'.$req->post('id'),
            'image'=>$imageValidation,
            'attrImage.*' => 'mimes:jpeg,jpg,png',
            'prodImage.*' => 'mimes:jpeg,jpg,png',
        ]);

        /* PRODUCT ATTRIBUTES */
        $pAttId = $req->post('pAttId');
        $skuArr = $req->post('sku');
        $mrpArr = $req->post('mrp');
        $priceArr = $req->post('price');
        $qtyArr = $req->post('qty');
        $sizeArr = $req->post('size');
        $colorArr = $req->post('color');
        foreach ($skuArr as $key=>$value) {
            $check = DB::table('productattr')->where('sku','=',$skuArr[$key])->where('id','!=',$pAttId[$key])->get();
            if (isset($check[0])) {
                $req->session()->flash('skuError', $skuArr[$key] .' SKU ALREADY USED');
                return redirect(request()->headers->get('referer'));
            }
        }

        if ($req->post('id') > 0) {
            $model = product::find($req->post('id'));   
            $msg = 'Product Upadated..!';
        } else {
            $model = new product();
            $msg = 'Product Inserted..!';
        }

        if ($req->hasfile('image')) {
            $image = $req->file('image');
            $ext = $image->extension();
            $imageName = time().'.'.$ext;
            $image->storeAs('/public/media/productImages', $imageName);
            $model->image = $imageName;
        }

        $model->id = $req->post('id');
        $model->categoryId = $req->post('categoryId');
        $model->name = $req->post('name');
        $model->slug = $req->post('slug');
        $model->brand = $req->post('brand');
        $model->model = $req->post('model');
        $model->shortDesc = $req->post('shortDesc');
        $model->desc = $req->post('desc');
        $model->keywords = $req->post('keywords');
        $model->technicalSpecs = $req->post('technicalSpecs');
        $model->uses = $req->post('uses');
        $model->warranty = $req->post('warranty');
        $model->leadTime = $req->post('leadTime');
        $model->tax = $req->post('tax');
        $model->taxType = $req->post('taxType');
        $model->save();

        $pid = $req->post('id');
        foreach ($skuArr as $key=>$value) {
            $productAttriArray['productId'] = $pid;
            $productAttriArray['id'] = $pAttId[$key];
            $productAttriArray['sku'] = $skuArr[$key];
            $productAttriArray['mrp'] = $mrpArr[$key];
            $productAttriArray['price'] = $priceArr[$key];
            $productAttriArray['qty'] = $qtyArr[$key];
            $productAttriArray['size'] = $sizeArr[$key];
            $productAttriArray['color'] = $colorArr[$key];

            if($req->hasFile("attrImage.$key")){
                $attrImg = $req->file("attrImage.$key");
                $ext = $attrImg->extension();
                $imageName = rand(1111111111, 2147483647).'.'.$ext;
                $req->file("attrImage.$key")->storeAs('/public/media/productAttrImages', $imageName);
                $productAttriArray['attrImage'] = $imageName;
            }

            if ($pAttId[$key] == "") {
                DB::table('productattr')->insert($productAttriArray);
            } else {
                $imageArr = DB::table('productattr')->where(['id'=>$pAttId[$key]])->get();
                if (Storage::exists('/public/media/productAttrImages/'.$imageArr[0]->attrImage)) {
                    Storage::delete('/public/media/productAttrImages/'.$imageArr[0]->attrImage);
                }
                DB::table('productattr')->where(['id'=>$pAttId[$key]])->update($productAttriArray);
            }
            unset($productAttriArray['attrImage']);
        }

        /* PRODUCT IMAGES */
        $prodImages = $req->post('prodImageId');
        foreach ($prodImages as $key => $value) { 
            $prodImage['productId'] = $pid;
            if($req->hasFile("prodImage.$key")){
                $prodImg = $req->file("prodImage.$key");
                $ext = $prodImg->extension();
                $imageName = rand(1111111111, 2147483647).'.'.$ext;
                $req->file("prodImage.$key")->storeAs('/public/media/productImages', $imageName);
                $prodImage['image'] = $imageName;
            }

            if ($prodImages[$key] == "") {
                DB::table('productimages')->insert($prodImage);
            } else {
                $imageArr = DB::table('productimages')->where(['id'=>$prodImages[$key]])->get();
                if (Storage::exists('/public/media/productImages/'.$imageArr[0]->attrImage)) {
                    Storage::delete('/public/media/productImages/'.$imageArr[0]->attrImage);
                }
                DB::table('productimages')->where(['id'=>$prodImages[$key]])->update($prodImage);
            }
            unset($prodImage['image']);
        }

        $req->session()->flash('message', $msg);
        return redirect('admin/product');
    }

    public function deleteProductImage(Request $req, $id)
    {
        $imageArr = DB::table('productimages')->where(['id'=>$id])->get();
        if (Storage::exists('/public/media/productImages/'.$imageArr[0]->image)) {
            Storage::delete('/public/media/productImages/'.$imageArr[0]->image);
        }
        DB::table('productimages')->where(['id'=>$id])->delete();
        $req->session()->flash('message','Product Image deleted..!');
        return redirect('admin/product');
    }

    public function deleteProductAttr(Request $req, $id)
    {
        $imageArr = DB::table('productattr')->where(['id'=>$id])->get();
        if (Storage::exists('/public/media/productAttrImages/'.$imageArr[0]->attrImage)) {
            Storage::delete('/public/media/productAttrImages/'.$imageArr[0]->attrImage);
        }

        DB::table('productattr')->where(['id'=>$id])->delete();
        $req->session()->flash('message','Product Attribute deleted..!');
        return redirect('admin/product');
    }

    public function deleteProduct(Request $req, $id)
    {
        $model = product::find($id);
        if (Storage::exists('/public/media/productImages/'.$model->attrImage)) {
            Storage::delete('/public/media/productImages/'.$model->attrImage);
        }
        $model->delete();
        
        $req->session()->flash('message','Product deleted..!');
        return redirect('admin/product');
    }

    public function editTrendingStatus($id, $status)
    {
        $model = product::find($id);   
        $model->isTrending = $status;
        $model->save();
        return redirect('admin/product/manageProduct/'.$id);
    } 

    public function editDiscountStatus($id, $status)
    {
        $model = product::find($id);   
        $model->isDiscounted = $status;
        $model->save();
        return redirect('admin/product/manageProduct/'.$id);
    } 

    public function editFeaturedStatus($id , $status)
    {
        $model = product::find($id);   
        $model->isFeatured = $status;
        $model->save();
        return redirect('admin/product/manageProduct/'.$id);
    } 

    public function editPromoStatus($id, $status)
    {
        $model = product::find($id);   
        $model->isPromo = $status;
        $model->save();
        return redirect('admin/product/manageProduct/'.$id);
    }   
}
