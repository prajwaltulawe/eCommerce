<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $result['sizeId'] = $arr['0']->categoryId;
            $result['colorId'] = $arr['0']->categoryId;
            $result['qty'] = $arr['0']->qty;
            $result['attrImage'] = $arr['0']->attrImage;
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
            $result['sizeId'] = "";
            $result['colorId'] = "";
            $result['qty'] = "";
            $result['attrImage'] = "";
            $result['buttonStatus'] = "Add Product"; 
        }

        $result['category'] = DB::table('categories')->where(['categoryStatus'=>1])->get();
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
        ]);

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
/*         $model->sizeId = $req->post('sizeId');
        $model->colorId = $req->post('colorId');
        $model->qty = $req->post('qty');
        $model->attrImage = $req->post('attrImage'); */
        $model->save();

        $pid = $req->post('id');
        
        /* PRODUCT ATTRIBUTES */
        $skuArr = $req->post('sku');
        $mrpArr = $req->post('mrp');
        $priceArr = $req->post('price');
        $qtyArr = $req->post('qty');
        $sizeArr = $req->post('size');
        $colorArr = $req->post('color');
        $attrImgArr = $req->post('attrImage');
        foreach ($skuArr as $key=>$value) {
            $productAttriArray['productId'] = $pid;
            $productAttriArray['sku'] = $skuArr[$key];
            $productAttriArray['mrp'] = $mrpArr[$key];
            $productAttriArray['price'] = $priceArr[$key];
            $productAttriArray['qty'] = $qtyArr[$key];
            $productAttriArray['size'] = $sizeArr[$key];
            $productAttriArray['color'] = $colorArr[$key];
            $productAttriArray['attrImage'] = $attrImgArr[$key];
            DB::table('productattr')->insert($productAttriArray);
        }
        $req->session()->flash('message', $msg);
        return redirect('admin/product');
    }

    public function deleteProduct(Request $req, $id)
    {
        $model = product::find($id);
        $model->delete();
        
        $req->session()->flash('message','Product deleted..!');
        return redirect('admin/product');
    }
}
