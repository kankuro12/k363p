@extends('layouts.vendor.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                {{$review->review_title}}
            </div>
            <hr>
            <div class="card-body">
                {{$review->review_description}}
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Review by {{$review->vendor_user->fname." ".$review->vendor_user->lname}} at {{$review->created_at}}
            </div>
            <div class="card-body">                        
                <table class="table table-hover">
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
                            <td>Overall</td>
                            <td>{{$review->all_rating()}}</td>                                        
                        </tr>
                </table>                
            </div>
        </div>
    </div>
</div>
@endsection