@extends('admin/layout')

@section('activeLinkCoupon','active')
@section('pageTitle','Manage Coupon')

@section('cointainer')
<div class="card">
    <div class="card-header">Manage Coupon</div>
    <div class="card-body">
        <form action="{{route('coupon.manage')}}" method="post" novalidate="novalidate">
            @csrf
            <div class="form-group">
                <label for="title" class="control-label mb-1">Title</label>
                <input id="title" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$title}}">
                @error('title')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="code" class="control-label mb-1">Code</label>
                <input id="code" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$code}}">
                @error('code')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="value" class="control-label mb-1">Value</label>
                <input id="value" name="value" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$value}}">
                @error('value')
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
<a href="{{url('admin/coupon')}}">
    <button type="button" class="btn btn-success btn-lg">Back</button>
</a>
@endsection