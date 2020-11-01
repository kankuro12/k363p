@extends('layouts.vendor.index')
@section('content') 
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>Change Email Address</h5>
      </div>
      <div class="card-body">
        @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <strong>{{ Session::get('error') }}</strong>
        </div>
        @endif
        @if(Session::has('info'))
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <strong>{{ Session::get('info') }}</strong>
        </div>
        @endif
        <form id="change_email" action="{{route('vendor.post_settings_change_email')}}" method="post">
              {{csrf_field()}}
              <div class="form-group">
                    <label>Current Email Address</label>
                    <input type="email" placeholder="Enter Your Current Email Address" name="currentEmail" class="form-control">
              </div>
              <div class="form-group">
                    <label>New Email Address</label>
                    <input type="email" placeholder="Enter New Email Address" name="newEmail" class="form-control">
              </div>                                            
              <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="javascript:history.back()" class="btn btn-primary">Cancel</a>
              </div>
        </form> 
      </div>
    </div>
  </div>
</div>
@endsection