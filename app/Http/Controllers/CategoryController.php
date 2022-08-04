<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $result['data'] = category::all();
        return view('admin/category',$result);
    }

    public function manageCategory($id = '', $status = '')
    {
        if ($id > 0 && $status != '') {
            $model = category::find($id);   
            $model->categoryStatus = $status;
            $model->save();
            return redirect('admin/category');
        }
        elseif ($id > 0) {
            $arr= category::where(['id'=>$id])->get();
            
            $result['categoryName'] = $arr['0']->categoryName;
            $result['categorySlug'] = $arr['0']->categorySlug;
            $result['categoryParentId'] = $arr['0']->categoryParentId;
            $result['categoryImage'] = $arr['0']->categoryImage;
            $result['id'] = $arr['0']->id;
            $result['buttonStatus'] = "Edit Record"; 
        }
        else{
            $result['categoryName'] = '';
            $result['categorySlug'] = '';
            $result['categoryParentId'] = "";
            $result['categoryImage'] = "";
            $result['id'] = '0';
            $result['buttonStatus'] = "Add Category"; 
        }
        $result['category'] = DB::table('categories')->where(['categoryStatus'=>1])->where('id','!=',$id)->get();
        return view('admin.manageCategory', $result);
    }

    public function manageCategoryProcess(Request $req)
    {
        $req->validate([
            'categoryName'=>'required',
            'image'=>'mimes:jpeg,jpg,png',
            'categorySlug'=>'required|unique:categories,categorySlug,'.$req->post('id'),
        ]);

        if ($req->post('id') > 0) {
            $model = category::find($req->post('id'));   
            $msg = 'Category Upadated..!';
        } else {
            $model = new category();
            $msg = 'Category Inserted..!';
        }
        
        if ($req->hasfile('categoryImage')) {
            $image = $req->file('categoryImage');
            $ext = $image->extension();
            $imageName = time().'.'.$ext;
            $image->storeAs('/public/media/categoryImages', $imageName);
            $model->categoryImage = $imageName;
        }

        $model->categoryName = $req->post('categoryName');
        $model->categorySlug = $req->post('categorySlug');
        $model->categoryParentId = $req->post('categoryParentId');
        $model->save();
        
        $req->session()->flash('message', $msg);
        return redirect('admin/category');
    }

    public function deleteCategory(Request $req, $id)
    {
        $model = category::find($id);
        $model->delete();
        
        $req->session()->flash('message','Category deleted..!');
        return redirect('admin/category');
    }
}
