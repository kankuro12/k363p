@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Payment Method({{$pm->name}})</h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    <ul class="list-group">
                      <li class="list-group-item">Name:{{$pm->name}}</li>
                      <li class="list-group-item">
                        <img src="{{asset('uploads/admin/payment_methods/logos/200x200/'.$pm->logo)}}">
                      </li>
                      <li class="list-group-item">Test Public Key:{{$pm->test_public_key}}</li>
                      <li class="list-group-item">Test Secret Key:{{$pm->test_secret_key}}</li>
                      <li class="list-group-item">Live Public Key:{{$pm->live_public_key}}</li>
                      <li class="list-group-item">Live Secret Key:{{$pm->live_secret_key}}</li>
                      <li class="list-group-item">Mode:{{$pm->mode}}</li>
                      <li class="list-group-item">Status:{{$pm->status}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection