@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>States
                  <a href="{{route('admin.get_create_state')}}" class="btn btn-success pull-right">Add New State</a>
                </h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table id="states" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>State Name</th>
                                <th>Country</th>                                 
                                <th>Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($states as $index=>$state)
                            <tr>
                            	<td>
                            		{{$index+1}}
                            	</td>
                            	<td>
                            		{{$state->name}}
                            	</td>
                            	<td>
                            		{{$state->country->name}}
                            	</td>                                
                                <td>
                                    <a href="{{route('admin.get_edit_state',['id'=>$state->id])}}" class="btn btn-success btn-sm"><i class="ion-ios-compose-outline"></i></a>
                                    <a href="{{route('admin.delete_state',['id'=>$state->id])}}" class="btn btn-primary btn-sm"><i class="ion-ios-trash-outline"></i></a>
                                </td>
                            </tr>                            
                            @endforeach
                    </table>
                    {{$states->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
