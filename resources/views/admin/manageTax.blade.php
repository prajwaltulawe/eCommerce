@extends('admin/layout')

@section('activeLinkTax','active')
@section('pageTitle','Manage Tax')

@section('cointainer')
<div class="card">
    <div class="card-header">Manage Tax</div>
    <div class="card-body">
        <form action="{{route('tax.manage')}}" method="post" novalidate="novalidate">
            @csrf
            <div class="form-group">
                <label for="taxValue" class="control-label mb-1">Tax Value</label>
                <input id="taxValue" name="taxValue" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$taxValue}}">
                @error('taxValue')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="taxDesc" class="control-label mb-1">Tax Description</label>
                <input id="taxDesc" name="taxDesc" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$taxDesc}}">
                @error('taxDesc')
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
<a href="{{url('admin/tax')}}">
    <button type="button" class="btn btn-success btn-lg">Back</button>
</a>
@endsection