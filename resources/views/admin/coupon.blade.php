@extends('admin/layout')

@section('activeLinkCoupon','active')
@section('pageTitle','Coupon')

@section('cointainer')
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Code</th>
                <th>Value</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->title}}</td>
                <td>{{$list->code}}</td>
                <td>{{$list->value}}</td>
                <td>
                    @if($list->status == 1 )
                        <a href="{{url('admin/coupon/manageCoupon')}}/{{$list->id}}/0"><button type="button" class="btn btn-success">Active</button></a>
                    @else
                        <a href="{{url('admin/coupon/manageCoupon')}}/{{$list->id}}/1"><button type="button" class="btn btn-secondary">Deactivated</button></a>
                    @endif
                </td>
                <td>
                    <a href="{{url('admin/coupon/manageCoupon')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>
                    <a href="{{url('admin/coupon/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="{{url('admin/coupon/manageCoupon')}}">
    <button type="button" class="btn btn-success btn-lg">Manage Coupon</button>
</a>
@endsection