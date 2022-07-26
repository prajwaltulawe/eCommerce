@extends('admin/layout')

@section('activeLinkColor','active')
@section('pageTitle','Color')

@section('cointainer')
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Color</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->color}}</td>
                <td>
                    @if($list->status == 1 )
                        <a href="{{url('admin/color/manageColor')}}/{{$list->id}}/0"><button type="button" class="btn btn-success">Active</button></a>
                    @else
                        <a href="{{url('admin/color/manageColor')}}/{{$list->id}}/1"><button type="button" class="btn btn-secondary">Deactivated</button></a>
                    @endif
                </td>
                <td>
                    <a href="{{url('admin/color/manageColor')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>
                    <a href="{{url('admin/color/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="{{url('admin/color/manageColor')}}">
    <button type="button" class="btn btn-success btn-lg">Manage Color</button>
</a>
@endsection