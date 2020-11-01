@extends('layouts.vendor.index')
@section('content') 
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>Change Password</h5>
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
        <form id="change_password" action="{{route('vendor.post_settings_change_password')}}" method="post">
              {{csrf_field()}}
              <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" placeholder="Enter Your Current Password" name="currentPassword" class="form-control">
              </div>
              <div class="form-group">
                    <label>New Password</label>
                    <input type="password" id="password" placeholder="Enter new Password" name="newpassword" class="form-control">
              </div>
              <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" placeholder="Confirm new Password" name="newpassword_confirmation" class="form-control">
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