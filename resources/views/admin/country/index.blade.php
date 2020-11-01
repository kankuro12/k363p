@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Countries
              <a href="{{route('admin.get_create_country')}}" class="btn btn-success pull-right">Add New Country</a></h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table id="" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Country Name</th>
                                <th>Phonecode</th>
                                <th>Sortname</th>
                                <th>Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($countries as $index=>$country)
                            <tr>
                            	<td>
                            		{{$index+1}}
                            	</td>
                            	<td>
                            		{{$country->name}}
                            	</td>
                                <td>
                                    {{$country->phonecode}}
                                </td>
                                <td>
                                    {{$country->sortname}}
                                </td>
                                <td>
                                    <a href="{{route('admin.get_edit_country',['id'=>$country->id])}}" class="btn btn-success btn-sm"><i class="ion-ios-compose-outline"></i></a>
                                    <a href="{{route('admin.delete_country',['id'=>$country->id])}}" class="btn btn-primary btn-sm"><i class="ion-ios-trash-outline"></i></a>
                                </td>
                            </tr>                            
                            @endforeach
                    </table>
                    {{$countries->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
