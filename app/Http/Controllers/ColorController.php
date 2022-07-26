<?php

namespace App\Http\Controllers;

use App\Models\color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['data'] = color::all();
        return view('admin/color',$result);
    }

    public function manageColor($id = '', $status = '')
    {
        if ($id > 0 && $status != '') {
            $model = color::find($id);   
            $model->status = $status;
            $model->save();
            return redirect('admin/color');
        }
        elseif ($id > 0) {
            $arr= color::where(['id'=>$id])->get();
            
            $result['id'] = $arr['0']->id;
            $result['color'] = $arr['0']->color; 
            $result['buttonStatus'] = "Edit Color"; 
        }
        else{
            $result['id'] = '0';
            $result['color'] = ''; 
            $result['buttonStatus'] = "Add Color"; 
        }
        return view('admin.manageColor', $result);
    }

    public function manageColorProcess(Request $req)
    {
        $req->validate([
            'color'=>'required|unique:color',
        ]);

        if ($req->post('id') > 0) {
            $model = color::find($req->post('id'));   
            $msg = 'Color Upadated..!';
        } else {
            $model = new color();
            $msg = 'Color Inserted..!';
        }
        
        $model->color = $req->post('color');
        $model->save();
        
        $req->session()->flash('message', $msg);
        return redirect('admin/color');
    }

    public function deleteColor(Request $req, $id)
    {
        $model = color::find($id);
        $model->delete();
        
        $req->session()->flash('message','Color deleted..!');
        return redirect('admin/color');
    }
}
