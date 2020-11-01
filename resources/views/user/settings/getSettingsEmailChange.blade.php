@extends('layouts.public.index')
@section('content') 
@include('user.nav')
<section class="dashboard-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-sidebar sticky-top">
                    @include('user.sidebar')
                </div>
            </div>
            <div class="col-md-9">
                <div class="dashboard-content-wrapper p-4">
                    <h4 class="mb-3 color1 font-weight-bold">Change Email Address</h4>
                    <div class="dash-user-favourites">
                     @if(Session::has('error'))
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">×</span>
                       </button>
                       <strong>{{ Session::get('error') }}</strong>
                     </div>
                     @endif
                     @if(Session::has('info'))
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">×</span>
                       </button>
                       <strong>{{ Session::get('info') }}</strong>
                     </div>
                     @endif
                        <form id="change_email" action="{{route('user.post_settings_change_email')}}" method="post">
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
                                    <button type="submit" class="btn btn1">Save</button>
                                    <a href="javascript:history.back()" class="btn btn-success my-2 my-sm-0 text-white">Cancel</a>
                              </div>
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 

@endsection