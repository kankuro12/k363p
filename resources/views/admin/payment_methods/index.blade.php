@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Payment Methods
              <a href="{{route('admin.get_create_payment_mode')}}" class="btn btn-success pull-right">Add Payment Method</a>
              </h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table id="amenities" class="table table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th> 
                                <th>key</th>                                
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Status</th>
                                <th>Created At</th>   
                                <th>Action</th>                             
                            </tr>
                            @foreach($payment_methods as $i=>$pm)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$pm->pkey}}</td>
                                <td>{{$pm->name}}</td>
                                <td>
                                    <img src="{{asset('uploads/admin/payment_methods/logos/200x200/'.$pm->logo)}}">
                                </td>
                                <td>{{$pm->status}}</td>
                                <td>{{$pm->created_at}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{route('admin.get_show_payment_mode',['id'=>$pm->id])}}">View</a>
                                    <a class="btn btn-info" href="{{route('admin.get_edit_payment_mode',['id'=>$pm->id])}}">Edit</a>
                                    <a class="btn btn-primary" href="{{route('admin.get_delete_payment_mode',['id'=>$pm->id])}}">Delete</a>
                                </td>
                                
                            </tr>
                            @endforeach
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection