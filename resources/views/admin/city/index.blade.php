@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Cities
                  <a href="{{route('admin.get_create_city')}}" class="btn btn-success pull-right">Add city</a>
                </h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table id="" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>City Name</th>
                                <th>State</th>                                
                                <th>Country</th>                                 
                                <th>Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cities as $index=>$city)
                            <tr>
                            	<td>
                            		{{$index+1}}
                            	</td>
                            	<td>
                            		{{$city->name}}
                            	</td>
                                <td>
                                    {{$city->state->name}}
                                </td>
                            	<td>
                            		{{$city->state->country->name}}
                            	</td>                                
                                <td>
                                    <a href="{{route('admin.get_edit_city',['id'=>$city->id])}}" class="btn btn-success btn-sm"><i class="ion-ios-compose-outline"></i></a>
                                    <a href="{{route('admin.delete_city',['id'=>$city->id])}}" class="btn btn-primary btn-sm"><i class="ion-ios-trash-outline"></i></a>
                                </td>
                            </tr>                            
                            @endforeach
                    </table>
                    {{$cities->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
