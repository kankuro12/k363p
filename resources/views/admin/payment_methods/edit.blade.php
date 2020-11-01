@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Payment Method({{$pm->name}})</h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                @include('layouts.admin.snippets.error')
                <form method="post" action="{{route('admin.post_update_payment_mode',['id'=>$pm->id])}}" enctype="multipart/form-data" id="addPayment">
                     @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="key">Key</label>                        
                                <input type="text" class="form-control" id="key" placeholder="key" name="pkey" value="{{$pm->pkey}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Payment Name</label>                        
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$pm->name}}">
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon</label>                        
                                <input type="file" class="form-control" id="logo" name="logo">
                                <div style="padding: 10px;">
                                	<img src="{{asset('uploads/admin/payment_methods/logos/200x200/'.$pm->logo)}}" height="80px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="test_public_key">Test Public key</label>                        
                                <input type="text" class="form-control" id="test_public_key" placeholder="Public key" name="test_public_key" value="{{$pm->test_public_key}}">
                            </div>
                            <div class="form-group">
                                <label for="test_secret_key">Test Secret key</label>                        
                                <input type="text" class="form-control" id="test_secret_key" placeholder="Secret key" name="test_secret_key" value="{{$pm->test_secret_key}}">
                            </div>
                            <div class="form-group">
                                <label for="live_public_key">Live Public key</label>                        
                                <input type="text" class="form-control" id="live_public_key" placeholder="Public key" name="live_public_key" value="{{$pm->live_public_key}}">
                            </div>
                            <div class="form-group">
                                <label for="live_secret_key">Live Secret key</label>                        
                                <input type="text" class="form-control" id="live_secret_key" placeholder="Secret key" name="live_secret_key" value="{{$pm->live_secret_key}}">
                            </div>
                            <div class="form-group">
                             <label>Mode</label>
                             <select class="form-control" name="mode" required="">
                                 <option value="">Select Mode</option>
                                 <option value="live" {{$pm->mode=='live'?'selected':''}}>Live</option>
                                 <option value="testing" {{$pm->mode=='testing'?'selected':''}}>Testing</option>
                             </select>
                            </div>
                            <div class="form-group">
                             <label>Status</label>
                             <select class="form-control" name="status" required="">
                                 <option value="">Select Status</option>
                                 <option value="active" {{$pm->status=='active'?'selected':''}}>Active</option>
                                 <option value="inactive" {{$pm->status=='inactive'?'selected':''}}>Inactive</option>
                             </select>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" value={{$pm->description}}>{{$pm->description}}</textarea>
                            </div>
                        </div>                        
                        <div class="card-body">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                        
                    </form>          
                </div>
            </div>
        </div>
    </div>
</div>
@endsection