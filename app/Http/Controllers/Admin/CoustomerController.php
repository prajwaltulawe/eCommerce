<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\coustomer;
use Illuminate\Http\Request;

class CoustomerController extends Controller
{
    public function index()
    {
        $result['data'] = coustomer::all();
        return view('admin/coustomer',$result);
    }

    public function editCoustomerStatus($id = '', $status = '')
    {
        $model = coustomer::find($id);   
        $model->status = $status;
        $model->save();
        return redirect('admin/coustomer');
    }
    public function viewCoustomerStatus($id)
    {
        $result['data'] = coustomer::find($id);
        return view('admin/coustomerDetails', $result);
    } 
}
