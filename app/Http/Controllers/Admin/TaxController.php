<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $result['data'] = tax::all();
        return view('admin/tax',$result);
    }

    public function manageTax($id = '', $status = '')
    {
        if ($id > 0 && $status != '') {
            $model = tax::find($id);   
            $model->status = $status;
            $model->save();
            return redirect('admin/tax');
        }
        elseif ($id > 0) {
            $arr= tax::where(['id'=>$id])->get();
            $result['id'] = $arr['0']->id;
            $result['taxValue'] = $arr['0']->taxValue; 
            $result['taxDesc'] = $arr['0']->taxDesc; 
            $result['buttonStatus'] = "Edit Tax"; 
        }
        else{
            $result['id'] = '0';
            $result['taxValue'] = ""; 
            $result['taxDesc'] = ""; 
            $result['buttonStatus'] = "Add Tax"; 
        }
        return view('admin.manageTax', $result);
    }

    public function manageTaxProcess(Request $req)
    {
        $req->validate([
            'taxValue'=>'required|unique:taxes',
        ]);

        if ($req->post('id') > 0) {
            $model = tax::find($req->post('id'));   
            $msg = 'Tax Upadated..!';
        } else {
            $model = new tax();
            $msg = 'Tax Inserted..!';
        }
        
        $model->taxValue = $req->post('taxValue');
        $model->taxDesc = $req->post('taxDesc');
        $model->save();
        
        $req->session()->flash('message', $msg);
        return redirect('admin/tax');
    }

    public function deleteTax(Request $req, $id)
    {
        $model = tax::find($id);
        $model->delete();
        
        $req->session()->flash('message','Tax deleted..!');
        return redirect('admin/tax');
    }
}