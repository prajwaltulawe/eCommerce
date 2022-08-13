@extends('admin/layout')

@section('activeLinkBannerImages','active')
@section('pageTitle','Banner Images')

@section('cointainer')
<div class="card">
    <div class="card-header">Manage Banner Images</div>
    <div class="card-body">
        <form action="{{route('bannerImages.manage')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="bannerTitle" class="control-label mb-1">Banner Title</label>
                <input id="bannerTitle" name="bannerTitle" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$bannerTitle}}">
            </div>
            <div class="form-group">
                <label for="bannerTxt" class="control-label mb-1">Banner Text</label>
                <input id="bannerTxt" name="bannerTxt" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$bannerTxt}}">
            </div>
            <div class="form-group" style="display: flex;justify-content: space-between;">
                <div class="form-group col-md-6 pl-0">
                    <label for="btnTxt" class="control-label mb-1">Button Text</label>
                    <input id="btnTxt" name="btnTxt" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$btnTxt}}">
                </div>
                <div class="form-group col-md-6 pr-0">
                    <label for="btnLink" class="control-label mb-1">Button Link</label>
                    <input id="btnLink" name="btnLink" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$btnLink}}">
                </div>
            </div>
            <div class="form-group" style="display: flex;justify-content: space-between;">
                <div class="form-group col-8" style="padding: 0;">
                    <label for="image" class="control-label mb-1 mt-1">Image</label>
                    <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false">
                    @error('image')
                    {{$message}}
                    @enderror
                </div>
                <img src="{{asset('storage/media/bannerImages/'.$image)}}" alt="" srcset="" class="mr-6 mt-4" style="width: 100px">
            </div>
            <input type="hidden" name="id" value="{{$id}}">
            <div>
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                    <span id="payment-button-amount">{{$buttonStatus}}</span>
                </button>
            </div>
            {{session('message')}}
        </form>
    </div>
</div>
<a href="{{url('admin/bannerImages')}}">
    <button type="button" class="btn btn-success btn-lg">Back</button>
</a>
@endsection