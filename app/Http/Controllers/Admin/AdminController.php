<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

class AdminController extends Controller
{
    public function index(Request $req)
    {
        if ($req->session()->has('ADMIN_LOGIN') ) {
            return redirect()->to('admin/dashboard');
        } else {
            return view('admin.login');
        }    
    }

    public function auth(Request $req)
    {
        $email = $req->post('email');
        $password = $req->post('password');

        // $result = Admin::where(['email'=>$email, 'password'=>$password])->get();

        $result = Admin::where(['email'=>$email])->first();
        if ($result) {
            if (hash::check($password,$result->password)) {
                $req->session()->put('ADMIN_LOGIN', true);
                $req->session()->put('ADMIN_ID', $result->id);
                return redirect()->to('admin/dashboard');
            }else{
                $req->session()->flash('error', 'Please enter correct password..!');
                return redirect()->to('admin');                
            }
        }else {
            $req->session()->flash('error', 'Please enter valid login details..!');
            return redirect()->to('admin');
        }    
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

/*     public function updatePassword()
    {
        $r = Admin::find(1);
        $r->password = Hash::make('123');
        $r->save();
    } */


}
