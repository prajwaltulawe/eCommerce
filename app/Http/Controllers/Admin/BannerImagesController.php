<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\bannerImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerImagesController extends Controller
{
    public function index()
    {
        $result['data'] = bannerImages::all();
        return view('admin/bannerImages',$result);
    }

    public function manageBannerImages($id = '', $status = '')
    {
        if ($id > 0 && $status != '') {
            $model = bannerImages::find($id);   
            $model->status = $status;
            $model->save();
            return redirect('admin/bannerImages');
        }
        elseif ($id > 0) {
            $arr= bannerImages::where(['id'=>$id])->get();
            $result['id'] = $arr['0']->id;
            $result['image'] = $arr['0']->image; 
            $result['bannerTitle'] = $arr['0']->bannerTitle; 
            $result['bannerTxt'] = $arr['0']->bannerTxt; 
            $result['btnTxt'] = $arr['0']->btnTxt; 
            $result['btnLink'] = $arr['0']->btnLink; 
            $result['buttonStatus'] = "Edit Brand"; 
        }
        else{
            $result['id'] = '0';
            $result['image'] = ''; 
            $result['bannerTitle'] = ''; 
            $result['bannerTxt'] = ''; 
            $result['btnTxt'] = ''; 
            $result['btnLink'] = ''; 
            $result['buttonStatus'] = "Add Banner"; 
        }
        return view('admin.manageBannerImages', $result);
    }

    public function manageBannerImagesProcess(Request $req)
    {

        $id = $req->post('id');
        if ($req->post('id') > 0) {
            $imageValidation = 'mimes:jpeg,jpg,png';
        } else {
            $imageValidation = 'required|mimes:jpeg,jpg,png';
        }

        $req->validate([
            'image'=>$imageValidation,
        ]);

        if ($req->post('id') > 0) {
            $model = bannerImages::find($req->post('id'));   
            $msg = 'Banner Upadated..!';
        } else {
            $model = new bannerImages();
            $msg = 'Banner Inserted..!';
        }
        
        if ($req->hasfile('image')) {
            $image = $req->file('image');
            $ext = $image->extension();
            $imageName = time().'.'.$ext;
            $image->storeAs('/public/media/bannerImages', $imageName);
            $model->image = $imageName;
        }

        $model->bannerTxt = $req->post('bannerTxt');
        $model->bannerTitle = $req->post('bannerTitle');
        $model->btnTxt = $req->post('btnTxt');
        $model->btnLink = $req->post('btnLink');
        $model->save();
        
        $req->session()->flash('message', $msg);
        return redirect('admin/bannerImages');
    }

    public function deleteBannerImage(Request $req, $id)
    {
        $imageArr = DB::table('banner_images')->where(['id'=>$id])->get();
        if (isset($imageArr[0]->image)) {
            if (Storage::exists('/public/media/bannerImages/'.$imageArr[0]->image)) {
                Storage::delete('/public/media/bannerImages/'.$imageArr[0]->image);
            }
        }
        $model = bannerImages::find($id);
        $model->delete();
        
        $req->session()->flash('message','Banner deleted..!');
        return redirect('admin/bannerImages');
    }
}
