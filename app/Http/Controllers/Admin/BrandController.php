<?php

namespace App\Http\Controllers\brand;

use App\Http\Controllers\Controller;
use App\Models\Admin\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $result['data'] = brand::all();
        return view('admin/brand',$result);
    }

    public function manageBrand($id = '', $status = '')
    {
        if ($id > 0 && $status != '') {
            $model = brand::find($id);   
            $model->status = $status;
            $model->save();
            return redirect('admin/brand');
        }
        elseif ($id > 0) {
            $arr= brand::where(['id'=>$id])->get();
            
            $result['id'] = $arr['0']->id;
            $result['imageRequired'] = ''; 
            $result['brand'] = $arr['0']->brand; 
            $result['image'] = $arr['0']->image; 
            $result['isHome'] = $arr['0']->isHome; 
            $result['buttonStatus'] = "Edit Brand"; 
        }
        else{
            $result['id'] = '0';
            $result['brand'] = '';
            $result['image'] = ''; 
            $result['isHome'] = ""; 
            $result['imageRequired'] = 'required'; 
            $result['buttonStatus'] = "Add Brand"; 
        }
        return view('admin.manageBrand', $result);
    }

    public function manageBrandProcess(Request $req)
    {

        $id = $req->post('id');
        if ($req->post('id') > 0) {
            $imageValidation = 'mimes:jpeg,jpg,png';
        } else {
            $imageValidation = 'required|mimes:jpeg,jpg,png';
        }

        if ($req->post('id') > 0) {
            $model = brand::find($req->post('id'));   
            $msg = 'Brand Upadated..!';
        } else {
            $model = new brand();
            $msg = 'Brand Inserted..!';
        }
        
        if ($req->hasfile('image')) {
            $image = $req->file('image');
            $ext = $image->extension();
            $imageName = time().'.'.$ext;
            $image->storeAs('/public/media/brandImages', $imageName);
            $model->image = $imageName;
        }

        $model->brand = $req->post('brand');
        $model->save();
        
        $req->session()->flash('message', $msg);
        return redirect('admin/brand');
    }

    public function setHomeDisplayStatus($id = '', $status = '')
    {
        $model = brand::find($id);   
        $model->isHome = $status;
        $model->save();
        return redirect('admin/brand');
    }

    public function deleteBrand(Request $req, $id)
    {
        $imageArr = DB::table('brands')->where(['id'=>$id])->get();
        if (Storage::exists('/public/media/brandImages/'.$imageArr[0]->attrImage)) {
            Storage::delete('/public/media/brandImages/'.$imageArr[0]->attrImage);
        }
        $model = brand::find($id);
        $model->delete();
        
        $req->session()->flash('message','Brand deleted..!');
        return redirect('admin/brand');
    }
}
