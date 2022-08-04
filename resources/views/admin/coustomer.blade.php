@extends('admin/layout')

@section('activeLinkCoustomers','active')
@section('pageTitle','Coustomers')

@section('cointainer')
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mob. No</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->name}}</td>
                <td>{{$list->email}}</td>
                <td>{{$list->mobileNo}}</td>
                <td>
                    @if($list->status == 1 )
                    <a href="{{url('admin/coustomer/manageCoustomerStatus')}}/{{$list->id}}/0"><button type="button" class="btn btn-success">Active</button></a>
                    @else
                    <a href="{{url('admin/coustomer/manageCoustomerStatus')}}/{{$list->id}}/1"><button type="button" class="btn btn-secondary">Deactivated</button></a>
                    @endif
                </td>
                <td><a href="{{url('admin/coustomer/viewCoustomerStatus')}}/{{$list->id}}"><button type="button" class="btn btn-success">View Details</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection