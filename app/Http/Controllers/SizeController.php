<?php

namespace App\Http\Controllers;

use App\Models\size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $result['data'] = size::all();
        return view('admin/size',$result);
    }

    public function manageSize($id = '', $status = '')
    {
        if ($id > 0 && $status != '') {
            $model = size::find($id);   
            $model->status = $status;
            $model->save();
            return redirect('admin/size');
        }
        elseif ($id > 0) {
            $arr= size::where(['id'=>$id])->get();
            
            $result['id'] = $arr['0']->id;
            $result['size'] = $arr['0']->size; 
            $result['buttonStatus'] = "Edit Size"; 
        }
        else{
            $result['id'] = '0';
            $result['size'] = ''; 
            $result['buttonStatus'] = "Add Size"; 
        }
        return view('admin.manageSize', $result);
    }

    public function manageSizeProcess(Request $req)
    {
        $req->validate([
            'size'=>'required|unique:sizes',
        ]);

        if ($req->post('id') > 0) {
            $model = size::find($req->post('id'));   
            $msg = 'Size Upadated..!';
        } else {
            $model = new size();
            $msg = 'Size Inserted..!';
        }
        
        $model->size = $req->post('size');
        $model->save();
        
        $req->session()->flash('message', $msg);
        return redirect('admin/size');
    }

    public function deleteSize(Request $req, $id)
    {
        $model = size::find($id);
        $model->delete();
        
        $req->session()->flash('message','Size deleted..!');
        return redirect('admin/size');
    }
}
