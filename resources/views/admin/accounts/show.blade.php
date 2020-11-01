@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Account Details</h5>
          </div>
          <div class="card-body">
          	<ul>
          		<li>Vendor Name:{{$account->vendor->name}}</li>
          		<li>Title:{{$account->title}}</li>
          		<li>Bill no:{{$account->invoice_number}}</li>
          		<li>Ammount:{{$account->ammount}}</li>
          		<li>Description:{{$account->description}}</li>
          		<div class="card-body">
          			<img src="{{asset('uploads/vendor/accounts/bills/'.$account->bill)}}">
          		</div>
          	</ul>
          </div>
        </div>
    </div>
</div>
@endsection
