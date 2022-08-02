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
            <div class="form-group" style="display: flex;justify-content: space-between;">
                <div class="form-group">
                    <label for="code" class="control-label mb-1">Code</label>
                    <input id="code" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$code}}">
                    @error('code')
                        {{$message}}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type" class="control-label mb-1">Type</label>
                    <select id="type" name="type" type="text" class="form-control col-12" aria-required="true" aria-invalid="false">
                        <option value="0" selected>Select Type</option>                
                        @if($type == "value")
                            <option value="value" selected>Value</option>
                        @else
                            <option value="value">Value</option>
                        @endif    

                        @if($type == "per")
                            <option value="per" selected>Percentage</option>                
                        @else
                            <option value="per">Percentage</option>                
                        @endif    
                    </select>
                    @error('type')
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
            </div>
            <div class="form-group" style="display: flex;justify-content: space-between;">
                <div class="form-group">
                    <label for="minOrderAmount" class="control-label mb-1">Minimum Order Amount</label>
                    <input id="minOrderAmount" name="minOrderAmount" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$minOrderAmount}}">
                    @error('minOrderAmount')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="form-group" style="display: flex;justify-content: space-between;">
                <div class="form-group">
                    <label for="isOneTime" class="control-label mb-1"> One Time :</label>
                    @if($isOneTime == 1 )
                        <a href="{{url('admin/coupon/manageCoupon/isOneTime')}}/{{$id}}/0"><button type="button" class="btn btn-success ml-2">Yes</button></a>
                    @else
                        <a href="{{url('admin/coupon/manageCoupon/isOneTime')}}/{{$id}}/1"><button type="button" class="btn btn-secondary ml-2">No</button></a>
                    @endif
                </div>
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