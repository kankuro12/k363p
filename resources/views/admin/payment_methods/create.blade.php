@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Add New Payment Method</h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                @include('layouts.admin.snippets.error')
                <form method="post" action="{{route('admin.post_store_payment_mode')}}" enctype="multipart/form-data" id="addPayment">
                     @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Key</label>                        
                                <input type="text" class="form-control" id="pkey" placeholder="pkey" name="pkey" value="{{old('pkey')}}">
                            </div>
                            <div class="form-group">
                                <label for="name">Payment Name</label>                        
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon</label>                        
                                <input type="file" class="form-control" id="logo" name="logo">
                            </div>
                            <div class="form-group">
                                <label for="test_public_key">Test Public key</label>                        
                                <input type="text" class="form-control" id="test_public_key" placeholder="Public key" name="test_public_key" value="{{old('test_public_key')}}">
                            </div>
                            <div class="form-group">
                                <label for="test_secret_key">Test Secret key</label>                        
                                <input type="text" class="form-control" id="test_secret_key" placeholder="Secret key" name="test_secret_key" value="{{old('test_secret_key')}}">
                            </div>
                            <div class="form-group">
                                <label for="live_public_key">Live Public key</label>                        
                                <input type="text" class="form-control" id="live_public_key" placeholder="Public key" name="live_public_key" value="{{old('live_public_key')}}">
                            </div>
                            <div class="form-group">
                                <label for="live_secret_key">Live Secret key</label>                        
                                <input type="text" class="form-control" id="live_secret_key" placeholder="Secret key" name="live_secret_key" value="{{old('live_secret_key')}}">
                            </div>
                            <div class="form-group">
                             <label>Mode</label>
                             <select class="form-control" name="mode" required="">
                                 <option value="">Select Mode</option>
                                 <option value="live" {{old('live')=='active'?'selected':''}}>Live</option>
                                 <option value="testing" {{old('testing')=='inactive'?'selected':''}}>Testing</option>
                             </select>
                            </div>
                            <div class="form-group">
                             <label>Status</label>
                             <select class="form-control" name="status" required="">
                                 <option value="">Select Status</option>
                                 <option value="active" {{old('status')=='active'?'selected':''}}>Active</option>
                                 <option value="inactive" {{old('status')=='inactive'?'selected':''}}>Inactive</option>
                             </select>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" value={{old('description')}}></textarea>
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