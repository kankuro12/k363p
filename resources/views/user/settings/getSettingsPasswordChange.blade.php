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
                   <h4 class="mb-3 color1 font-weight-bold">Change Password</h4>
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
                       <form id="change_password" action="{{route('user.post_settings_change_password')}}" method="post">
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