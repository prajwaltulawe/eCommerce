@extends('admin/layout')

@section('activeLinkBrand','active')
@section('pageTitle','Manage Brand')

@section('cointainer')
<div class="card">
    <div class="card-header">Manage Brand</div>
    <div class="card-body">
        <form action="{{route('brand.manage')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="brand" class="control-label mb-1">Brand</label>
                <input id="brand" name="brand" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$brand}}">
                @error('brand')
                    {{$message}}
                @enderror
            </div>
            <div class="brnadImagesContainer" style="display: flex;justify-content: space-between; align-items: center;">
                <div class="form-group col-8" style="padding: 0;">
                    <label for="image" class="control-label mb-1 mt-1">Image</label>
                    <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$imageRequired}}>
                    @error('image')
                    {{$message}}
                    @enderror
                </div>
                <img src="{{asset('storage/media/brandImages/'.$image)}}" alt="" srcset="" class="mr-6 mt-4" style="width: 100px">
                <div class="form-group col-8" style="padding: 0;">
                    <label for="categoryImage" class="control-label mb-1"></label>    
                    <div>
                        <label for="isHome" class="control-label mb-1 ml-5">Display On Home</label>    
                        @if($isHome == 1 )
                            <a href="{{url('admin/brand/setHomeDisplayStatusBrand')}}/{{$id}}/0"><button type="button" class="btn btn-success">Yes</button></a>
                        @else
                            <a href="{{url('admin/brand/setHomeDisplayStatusBrand')}}/{{$id}}/1"><button type="button" class="btn btn-secondary">No</button></a>
                        @endif
                    </div>
                </div>    
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
<a href="{{url('admin/brand')}}">
    <button type="button" class="btn btn-success btn-lg">Back</button>
</a>
@endsection