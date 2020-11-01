@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Accounts
                  <a href="{{route('admin.get_create_accounts')}}" class="pull-right btn btn-success">Add Account</a>
                </h5>
            </div>
            <div class="card-body">
              @include('layouts.vendor.snippets.msg')
              <div class="table-responsive">
                <table class="table table-hover" id="accounts">
                  <thead>
                    <th>Vendor</th>
                    <th>Bill</th>
                    <th>Payed At</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    @foreach($vendor_accounts as $va)
                    <tr>
                      <td>{{$va->vendor->name}}</td>
                      <td>
                        <img src="{{asset('uploads/vendor/accounts/bills/200x200/'.$va->bill)}}">
                      </td>
                      <td>{{$va->created_at}}</td>
                      <td>
                        <a href="{{route('admin.get_show_accounts',['id'=>$va->id])}}" class="btn btn-success">View</a>
                        <a href="{{route('admin.get_edit_accounts',['id'=>$va->id])}}" class="btn btn-info">Edit</a>
                        <a href="{{route('admin.delete_accounts',['id'=>$va->id])}}" class="btn btn-primary">Delete</a>
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
@section('scripts')
<script type="text/javascript">
  $("#accounts").DataTable();
</script>
@endsection
