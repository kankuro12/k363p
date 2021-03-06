@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Add Account</h5>
          </div>
          <div class="card-body">
            @include('layouts.vendor.snippets.error')
            <form method="post" action="{{route('admin.post_update_accounts',['id'=>$account->id])}}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Vendor</label>
                    <select name="vendor_id" class="form-control">
                      <option>Select Vendor</option>
                      @foreach($vendors as $vendor)
                      <option value="{{$vendor->id}}" {{$account->vendor_id==$vendor->id?'selected':''}}>{{$vendor->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{$account->title}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label>Bill</label>
                    <input type="file" name="bill" class="form-control">
                    <img src="{{asset('uploads/vendor/accounts/bills/200x200/'.$account->bill)}}">
                  </div>
                </div>
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label>Bill No</label>
                    <input type="text" name="bill_no" class="form-control" value="{{$account->invoice_number}}">
                  </div>
                </div>
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label>Ammount</label>
                    <input type="text" name="ammount" class="form-control" value="{{$account->ammount}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 pr-1">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description">{{$account->description}}</textarea>
                  </div>
                </div>
              </div>
              <button class="btn btn-success">Save</button>
              <button class="btn btn-primary">Reset</button>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection
