<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function auth(Request $req)
    {
        $email = $req->post('email');
        $password = $req->post('password');

        $result = Admin::where(['email'=>$email, 'password'=>$password])->get();
        if (isset($result['0']->id) ) {
            $req->session()->put('ADMIN_LOGIN', true);
            $req->session()->put('ADMIN_ID', $result['0']->id);
            return redirect('admin/dashboard');
        } else {
            $req->session()->flash('error', 'Please enter valid login details..!');
            return redirect('admin');
        }    
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

}
