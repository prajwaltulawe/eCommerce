@extends('admin/layout')

@section('activeLinkCoustomers','active')
@section('pageTitle','Coustomers')

@section('cointainer')
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <tbody>
            <tr>
                <td><strong>ID</strong></td>
                <td>{{$data->id}}</td>
            </tr>
            <tr>
                <td><strong>Name</strong></td>
                <td>{{$data->name}}</td>
            <tr>
                <td><strong>Email</strong></td>
                <td>{{$data->email}}</td>
            </tr>
            <tr>
                <td><strong>Mobile No.</strong></td>
                <td>{{$data->mobileNo}}</td>
            </tr>
            <tr>
                <td><strong>Address</strong></td>
                <td>{{$data->address}}</td>
            </tr>
            <tr>
                <td><strong>City</strong></td>
                <td>{{$data->city}}</td>
            </tr>
            <tr>
                <td><strong>State</strong></td>
                <td>{{$data->state}}</td>
            </tr>
            <tr>
                <td><strong>Zip</strong></td>
                <td>{{$data->zip}}</td>
            </tr>
            <tr>
                <td><strong>Company</strong></td>
                <td>{{$data->company}}</td>
            </tr>
            <tr>
                <td><strong>GST IN</strong></td>
                <td>{{$data->gstin}}</td>
            </tr>
            <tr>
                <td><strong>Acount Status</strong></td>
                <td>{{$data->status}}</td>
            </tr>
            <tr>
                <td><strong>Created On</strong></td>
                <td>{{\Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:I')}}</td>
            </tr>
            <tr>
                <td><strong>Updated On</strong></td>
                <td>{{\Carbon\Carbon::parse($data->updated_at)->format('d-m-Y H:I')}}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection