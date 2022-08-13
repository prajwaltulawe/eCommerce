@extends('admin/layout')

@section('activeLinkBannerImages','active')
@section('pageTitle','Banner Images')

@section('cointainer')
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Text</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>
                    <img src="{{asset('storage/media/bannerImages/'.$list->image)}}" alt="" srcset="" style="width: 100px">
                </td>
                <td>{{$list->bannerTitle}}</td>
                <td>{{$list->btnTxt}}</td>
                <td>
                    @if($list->status == 1 )
                        <a href="{{url('admin/bannerImages/managebannerImages')}}/{{$list->id}}/0"><button type="button" class="btn btn-success">Active</button></a>
                    @else
                        <a href="{{url('admin/bannerImages/managebannerImages')}}/{{$list->id}}/1"><button type="button" class="btn btn-secondary">Deactivated</button></a>
                    @endif
                </td>
                <td>
                    <a href="{{url('admin/bannerImages/managebannerImages')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>
                    <a href="{{url('admin/bannerImages/delete')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="{{url('admin/bannerImages/managebannerImages')}}">
    <button type="button" class="btn btn-success btn-lg">Add Banner</button>
</a>
@endsection