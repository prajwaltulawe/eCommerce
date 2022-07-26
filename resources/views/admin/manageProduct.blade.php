@extends('admin/layout')

@section('activeLinkProduct','active')
@section('pageTitle','Manage Product')

@if($id>0)
    {{$imageRequired = ""}}
@else
    {{$imageRequired = "required"}}
@endif

@section('cointainer')
<div class="card">
    <div class="card-header">Manage Product</div>
    <div class="card-body">
        <form action="{{route('product.manage')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="categoryId" class="control-label mb-1">Category</label>
                <select id="categoryId" name="categoryId" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    <option value="0" selected>Select Category</option>                
                    @foreach($category as $list)
                        @if($categoryId == $list->id)
                            <option value="{{$list->id}}" selected>{{$list->categoryName}}</option>                
                        @else
                            <option value="{{$list->id}}">{{$list->categoryName}}</option>
                        @endif    
                    @endforeach
                </select>             
                @error('categoryId')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="name" class="control-label mb-1">Name</label>
                <input id="name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$name}}">
                @error('name')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="slug" class="control-label mb-1">Slug</label>
                <input id="slug" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$slug}}">
                @error('slug')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="brand" class="control-label mb-1">Brand</label>
                <input id="brand" name="brand" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$brand}}">
                @error('brand')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="model" class="control-label mb-1">Model</label>
                <input id="model" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$model}}">
                @error('model')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="image" class="control-label mb-1">Image</label>
                <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" value="{{$image}}" {{$imageRequired}}>
                @error('image')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="shortDesc" class="control-label mb-1">Short Description</label>
                <input id="shortDesc" name="shortDesc" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$shortDesc}}">
                @error('shortDesc')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="desc" class="control-label mb-1">Description</label>
                <input id="desc" name="desc" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$desc}}">
                @error('desc')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="keywords" class="control-label mb-1">Keywords</label>
                <input id="keywords" name="keywords" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$keywords}}">
                @error('keywords')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="technicalSpecs" class="control-label mb-1">Technical Specifications</label>
                <input id="technicalSpecs" name="technicalSpecs" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$technicalSpecs}}">
                @error('technicalSpecs')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="uses" class="control-label mb-1">Uses</label>
                <input id="uses" name="uses" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$uses}}">
                @error('uses')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="warranty" class="control-label mb-1">Warranty</label>
                <input id="warranty" name="warranty" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$warranty}}">
                @error('warranty')
                    {{$message}}
                @enderror
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
<a href="{{url('admin/product')}}">
    <button type="button" class="btn btn-success btn-lg">Back</button>
</a>
@endsection