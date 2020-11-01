@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Manage Vendors to <b>{{$collection->name}}</b> Collection</h5>
            </div>
            <div class="card-body">
                @include('layouts.admin.snippets.msg')
                @include('layouts.admin.snippets.error')
                <form class="inlineform" action="{{route('admin.post_manage_product',['id'=>$collection->id])}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="text">Vendors:</label>
                          <select name="vendor_id" class="form-control">
                              <option value="" selected="" disabled="">Select Vendor</option>
                              @foreach($vendors as $vendor)
                              <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                              @endforeach
                          </select>
                        </div>                        
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
                </form>
                <div class="content table-responsive table-full-width">
                    <table class="table table-hover" id="vendors">
                        <thead>
                          <tr>
                            <th>Vendor</th>
                            <th>Created At</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($collectionvendors as $cv)
                          <tr>
                            <td>{{$cv->vendor->name}}</td>
                            <td>{{$cv->created_at}}</td>
                            <td>
                                <a href="{{route('admin.get_delete_product',['id'=>$cv->id])}}" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('styles')
<link href="{{asset('assets/admin/assets/datatable/datatables.min.css')}}" rel="stylesheet" />
@endsection
@section('scripts')
<script src="{{asset('assets/admin/assets/datatable/datatables.min.js')}}"></script>
<script>
$('#vendors').DataTable();
</script>
@endsection


