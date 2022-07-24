<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $result['data'] = category::all();
        return view('admin/category',$result);
    }

    public function manageCategory($id = '')
    {
        if ($id > 0) {
            $arr= category::where(['id'=>$id])->get();
            
            $result['categoryName'] = $arr['0']->categoryName;
            $result['categorySlug'] = $arr['0']->categorySlug;
            $result['id'] = $arr['0']->id;
            $result['buttonStatus'] = "Edit Record"; 
        }
        else{
            $result['categoryName'] = '';
            $result['categorySlug'] = '';
            $result['id'] = '0';
            $result['buttonStatus'] = "Add Category"; 
        }
        return view('admin.manageCategory', $result);
    }

    public function manageCategoryProcess(Request $req)
    {
        $req->validate([
            'categoryName'=>'required',
            'categorySlug'=>'required|unique:categories,categorySlug,'.$req->post('id'),
        ]);

        if ($req->post('id') > 0) {
            $model = category::find($req->post('id'));   
            $msg = 'Category Upadated..!';
        } else {
            $model = new category();
            $msg = 'Category Inserted..!';
        }
        
        $model->categoryName = $req->post('categoryName');
        $model->categorySlug = $req->post('categorySlug');
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
    }
}
