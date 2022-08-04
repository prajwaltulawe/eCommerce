@extends('admin/layout')

@section('activeLinkCategory','active')
@section('pageTitle','Manage Category')

@section('cointainer')
<div class="card">
    <div class="card-header">Manage Category</div>
    <div class="card-body">
        <form action="{{route('category.manage')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
            @csrf
            <div class="form-group" style="display: flex;justify-content: space-between;">
                <div class="form-group">
                    <label for="categoryName" class="control-label mb-1">Category Name</label>
                    <input id="categoryName" name="categoryName" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$categoryName}}">
                    @error('categoryName')
                        {{$message}}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="categoryParentId" class="control-label mb-1">Parent Category</label>
                    <select id="categoryParentId" name="categoryParentId" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        <option value="0" selected>Select Category</option>                
                        @foreach($category as $list)
                            @if($categoryParentId == $list->id)
                                <option value="{{$list->id}}" selected>{{$list->categoryName}}</option>                
                            @else
                                <option value="{{$list->id}}">{{$list->categoryName}}</option>
                            @endif    
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="categorySlug" class="control-label mb-1">Category Slug</label>
                    <input id="categorySlug" name="categorySlug" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$categorySlug}}">
                    @error('categorySlug')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="form-group" style="display: flex;justify-content: space-between;">
                <div class="form-group col-8" style="padding: 0;">
                    <label for="categoryImage" class="control-label mb-1">Image</label>
                    <input id="categoryImage" name="categoryImage" type="file" class="form-control" aria-required="true" aria-invalid="false">
                    @error('image')
                    {{$message}}
                    @enderror
                </div>
                <img src="{{asset('storage/media/categoryImages/'.$categoryImage)}}" alt="" srcset="" style="width: 100px; ">
            </div>
            <input type="hidden" name="id" value="{{$id}}">
   
            <div>
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                    <span id="payment-button-amount">{{$buttonStatus}}</span>
                    <span id="payment-button-sending" style="display:none;">Adding…</span>
                </button>
            </div>
            {{session('message')}}
        </form>
    </div>
</div>
<a href="{{url('admin/category')}}">
    <button type="button" class="btn btn-success btn-lg">Back</button>
</a>
@endsection