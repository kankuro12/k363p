@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Review Details</h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                	<div class="panel panel-default">
                	      <div class="panel-heading">{{$review->review_title}}<span class="pull-right">By:{{ucfirst($review->vendor_user->fname." ".$review->vendor_user->lname)}}</span></div>
                	      <div class="panel-body">
                	      	<div style="border:1px dotted #333;padding:10px;">
                	      		{{$review->review_description}}
                	      	</div>
                	      	
                	      	
                	      	 <table class="table table-bordered" style="margin-top: 10px;">
                                    <tr>
                                        <td>Clean</td>
                                        <td>{{$review->clean}}</td>                                        
                                    </tr>
                                    <tr>
                                        <td>Food</td>
                                        <td>{{$review->food}}</td>                                        
                                    </tr>
                                    <tr>
                                        <td>Comfort</td>
                                        <td>{{$review->comfort}}</td>                                        
                                    </tr>
                                    <tr>
                                        <td>Facility</td>
                                        <td>{{$review->facility}}</td>                                        
                                    </tr>
                                    <tr>
                                        <td>Staff Behaviour</td>
                                        <td>{{$review->sbehaviour}}</td>                                        
                                    </tr>
                                    <tr>
                                        <td>Overall</td>
                                        <td>{{$review->all_rating()}}</td>                                        
                                    </tr>
                                </table>

                	      </div>
                	</div>                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
