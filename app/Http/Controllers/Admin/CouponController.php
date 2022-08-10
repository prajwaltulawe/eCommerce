<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $result['data'] = coupon::all();
        return view('admin/coupon',$result);
    }

    public function manageCoupon($id = '', $status = '')
    {
        if ($id > 0 && $status != '') {
            $model = coupon::find($id);   
            $model->status = $status;
            $model->save();
            return redirect('admin/coupon');
        }
        elseif ($id > 0) {
            $arr= coupon::where(['id'=>$id])->get();
            
            $result['id'] = $arr['0']->id;
            $result['title'] = $arr['0']->title;
            $result['code'] = $arr['0']->code;
            $result['value'] = $arr['0']->value; 
            $result['type'] = $arr['0']->type; 
            $result['minOrderAmount'] = $arr['0']->minOrderAmount; 
            $result['isOneTime'] = $arr['0']->isOneTime; 
            $result['buttonStatus'] = "Edit Coupon"; 
        }
        else{
            $result['id'] = '0';
            $result['title'] = '';
            $result['code'] = '';
            $result['value'] = ''; 
            $result['type'] = '';
            $result['minOrderAmount'] = '';
            $result['isOneTime'] = '';
            $result['buttonStatus'] = "Add Coupon"; 
        }
        return view('admin.manageCoupon', $result);
    }

    public function manageCouponProcess(Request $req)
    {
        $req->validate([
            'title'=>'required',
            'value'=>'required',
            'code'=>'required|unique:coupons,code,'.$req->post('id'),
        ]);

        if ($req->post('id') > 0) {
            $model = coupon::find($req->post('id'));   
            $msg = 'Coupon Upadated..!';
        } else {
            $model = new coupon();
            $msg = 'Coupon Inserted..!';
        }
        
        $model->title = $req->post('title');
        $model->code = $req->post('code');
        $model->value = $req->post('value');
        $model->type = $req->post('type');
        $model->minOrderAmount = $req->post('minOrderAmount');
        $model->status = 1;
        $model->save();
        
        $req->session()->flash('message', $msg);
        return redirect('admin/coupon');
    }

    public function deleteCoupon(Request $req, $id)
    {
        $model = coupon::find($id);
        $model->delete();
        
        $req->session()->flash('message','Coupon deleted..!');
        return redirect('admin/coupon');
    }

    public function editOneTimeStatus($id, $status)
    {
        $model = coupon::find($id);   
        $model->isOneTime = $status;
        $model->save();
        return redirect('admin/coupon/manageCoupon/'.$id);
    }   
}
