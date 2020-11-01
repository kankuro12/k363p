@extends('layouts.vendor.index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Add Room</h4>
                    </div>
                    <div class="content">
                        <ul class="nav nav-pills">
                          <li role="presentation"><a href="{{route('vendor.get_create_rooms')}}">Basic Details</a></li>
                          <li role="presentation"><a href="{{route('vendor.get_amenities_rooms')}}">Amenities</a></li>
                          <li role="presentation"><a href="{{route('vendor.get_photos_rooms')}}">Photos</a></li>
                          <li role="presentation"><a href="{{route('vendor.get_privacy_policy_rooms')}}">Privacy Policy</a></li>
                          <li role="presentation"  class="active"><a href="{{route('vendor.get_payment_mode_rooms')}}">Payment Option</a></li>
                        </ul>
                        <hr>
                        <div id="statusBox"></div>
                        <form method="post" action="{{route('admin.post_create_room_type')}}" id="addType" enctype="multipart/form-data">
                            @csrf
                            <!-- <div class="card-body">                        
                                <div class="form-group">
                                    <label for="name">Room Type Name</label>                        
                                    <input type="text" class="form-control" id="name" placeholder="Room Type Name" name="name">
                                </div>   
                                <div class="form-group">
                                    <label for="name">Icon</label>                        
                                    <input type="file" class="form-control" id="file" name="icon">
                                </div>                       
                                <div class="form-group">
                                    <select class="form-control" name="status" required="">
                                        <option value="">Select Status</option>
                                        <option value="active" {{old('status'=='active'?'selected':'')}}>Active</option>
                                        <option value="inactive" {{old('status'=='inactive'?'selected':'')}}>Inactive</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </div>
                        </form>        
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
