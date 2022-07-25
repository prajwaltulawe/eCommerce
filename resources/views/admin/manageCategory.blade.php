@extends('admin/layout')

@section('activeLinkCategory','active')
@section('pageTitle','Manage Category')

@section('cointainer')
<div class="card">
    <div class="card-header">Manage Category</div>
    <div class="card-body">
        <form action="{{route('category.manage')}}" method="post" novalidate="novalidate">
            @csrf
            <div class="form-group">
                <label for="categoryName" class="control-label mb-1">Category Name</label>
                <input id="categoryName" name="categoryName" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$categoryName}}">
                @error('categoryName')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="categorySlug" class="control-label mb-1">Category Slug</label>
                <input id="categorySlug" name="categorySlug" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$categorySlug}}">
                @error('categorySlug')
                    {{$message}}
                @enderror
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