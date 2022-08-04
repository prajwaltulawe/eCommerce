@extends('admin/layout')

@section('activeLinkTax','active')
@section('pageTitle','Tax')

@section('cointainer')
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tax Description</th>
                <th>Tax Value</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->taxValue}}</td>
                <td>{{$list->taxDesc}}</td>
                <td>
                    @if($list->status == 1 )
                        <a href="{{url('admin/tax/manageTax')}}/{{$list->id}}/0"><button type="button" class="btn btn-success">Active</button></a>
                    @else
                        <a href="{{url('admin/tax/manageTax')}}/{{$list->id}}/1"><button type="button" class="btn btn-secondary">Deactivated</button></a>
                    @endif
                </td>
                <td>
                    <a href="{{url('admin/tax/manageTax')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>
                    <a href="{{url('admin/tax/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="{{url('admin/tax/manageTax')}}">
    <button type="button" class="btn btn-success btn-lg">Manage Tax</button>
</a>
@endsection