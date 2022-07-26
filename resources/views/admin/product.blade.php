@extends('admin/layout')

@section('activeLinkProduct','active')
@section('pageTitle','Product')

@section('cointainer')
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cat. Id</th>
                <th>Name</th>
                <th>Image</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->categoryId}}</td>
                <td>{{$list->name}}</td>
                <td>
                    <img src="{{asset('storage/app/public/media/productImages/'.$list->image)}}" alt="" srcset="">
                </td>
                <td>{{$list->brand}}</td>
                <td>{{$list->model}}</td>
                <td>
                    @if($list->status == 1 )
                        <a href="{{url('admin/product/manageProduct')}}/{{$list->id}}/0"><button type="button" class="btn btn-success">Active</button></a>
                    @else
                        <a href="{{url('admin/product/manageProduct')}}/{{$list->id}}/1"><button type="button" class="btn btn-secondary">Deactivated</button></a>
                    @endif
                </td>
                <td>
                    <a href="{{url('admin/product/manageProduct')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>
                    <a href="{{url('admin/product/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="{{url('admin/product/manageProduct')}}">
    <button type="button" class="btn btn-success btn-lg">Manage Product</button>
</a>
@endsection