@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Tourism Areas
                <a href="{{route('admin.get_tourisam_areas_create')}}" class="btn btn-success pull-right">Add Area</a>
            </h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table id="tourismareas" class="table table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>                                
                                <th>Name</th>
                                <th>Featured Image</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Created At</th>                                
                                <th>Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($tourismareas as $index=>$tr)
                        	<tr>
                                <td>{{$index+1}}</td>
                        		<td>{{$tr->name}}</td>
                        		<td>
                        			<img src="{{asset('uploads/tourismareas/200x200/'.$tr->featured_image)}}" height="40px" class="img-responsive">
                        		</td>
                        		<td>{{$tr->location}}</td>
                        		<td>{{$tr->status}}</td>
                        		<td>{{$tr->created_at}}</td>
                        		<td>
                        			<a href="{{route('admin.get_tourisam_areas_edit',['id'=>$tr->id])}}" class="btn btn-success btn-sm"><i class="ion-ios-compose-outline"></i></a>
                        			<a href="{{route('admin.delete_tourisam_area',['id'=>$tr->id])}}" class="btn btn-primary btn-sm"><i class="ion-ios-trash-outline"></i></a>
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
<script>
$('#tourismareas').DataTable();
</script>
@endsection