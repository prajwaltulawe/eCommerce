@extends('admin/layout')

@section('activeLinkSize','active')
@section('pageTitle','Size')

@section('cointainer')
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Size</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->size}}</td>
                <td>
                    @if($list->status == 1 )
                        <a href="{{url('admin/size/manageSize')}}/{{$list->id}}/0"><button type="button" class="btn btn-success">Active</button></a>
                    @else
                        <a href="{{url('admin/size/manageSize')}}/{{$list->id}}/1"><button type="button" class="btn btn-secondary">Deactivated</button></a>
                    @endif
                </td>
                <td>
                    <a href="{{url('admin/size/manageSize')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>
                    <a href="{{url('admin/size/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="{{url('admin/size/manageSize')}}">
    <button type="button" class="btn btn-success btn-lg">Manage Size</button>
</a>
@endsection