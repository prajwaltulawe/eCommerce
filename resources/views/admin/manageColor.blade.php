@extends('admin/layout')

@section('activeLinkColor','active')
@section('pageTitle','Manage Color')

@section('cointainer')
<div class="card">
    <div class="card-header">Manage Coupon</div>
    <div class="card-body">
        <form action="{{route('color.manage')}}" method="post" novalidate="novalidate">
            @csrf
            <div class="form-group">
                <label for="color" class="control-label mb-1">Color</label>
                <input id="color" name="color" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$color}}">
                @error('color')
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
<a href="{{url('admin/color')}}">
    <button type="button" class="btn btn-success btn-lg">Back</button>
</a>
@endsection