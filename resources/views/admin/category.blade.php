@extends('admin/layout')

@section('activeLinkCategory','active')
@section('pageTitle','Category')

@section('cointainer')
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Category Slug</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->categoryName}}</td>
                <td>{{$list->categorySlug}}</td>
                <td>
                    @if($list->categoryStatus == 1 )
                        <a href="{{url('admin/category/manageCategory')}}/{{$list->id}}/0"><button type="button" class="btn btn-success">Active</button></a>
                    @else
                        <a href="{{url('admin/category/manageCategory')}}/{{$list->id}}/1"><button type="button" class="btn btn-secondary">Deactivated</button></a>
                    @endif                    
                </td>
                <td>
                    <a href="{{url('admin/category/manageCategory')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>
                    <a href="{{url('admin/category/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="category/manageCategory">
    <button type="button" class="btn btn-success btn-lg">Manage Category</button>
</a>
@endsection