@extends('admin/layout')

@section('activeLinkSize','active')
@section('pageTitle','Manage Size')

@section('cointainer')
<div class="card">
    <div class="card-header">Manage Coupon</div>
    <div class="card-body">
        <form action="{{route('size.manage')}}" method="post" novalidate="novalidate">
            @csrf
            <div class="form-group">
                <label for="size" class="control-label mb-1">Size</label>
                <input id="size" name="size" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$size}}">
                @error('size')
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
<a href="{{url('admin/size')}}">
    <button type="button" class="btn btn-success btn-lg">Back</button>
</a>
@endsection