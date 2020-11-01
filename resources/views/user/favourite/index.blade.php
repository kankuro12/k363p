@extends('layouts.public.index')
@section('content')
@include('user.nav')
<section class="dashboard-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-sidebar sticky-top">
                    @include('user.sidebar')
                </div>
            </div>
            <div class="col-md-9">
                <div class="dashboard-content-wrapper p-4">
                    <h4 class="mb-3 color1 font-weight-bold">Your Favourites</h4>
                    <div class="dash-user-favourites">
                        @if($favs->count()>0)
                        <div class="row">                        
                          @foreach($favs as $index=>$fv) 
                            <div class="col-md-6">
                                <div class="dash-user-favourite">                                    
                                        <div class="fav-img-wrapper">
                                            <img src="{{asset('uploads/vendor/logo/263x160/'.$fv->vendor->logo)}}" class="img-fluid" style="height: 100%;width: 100%;object-fit: cover;">
                                            <a href="{{route('public.single_vendor',['slug'=>$fv->vendor->slug])}}">
                                            <div class="fav-detail-wrapper p-2">
                                                <h5 class="font-weight-bold">
                                                {{$fv->vendor->name}}</h5>
                                                <div class="fav-item-loc mb-1">
                                                    <i class="ion-android-pin"></i>
                                                    <span> {{$fv->vendor->location->name}}</span>
                                                </div>
                                                <div class="avg-cost">
                                                    Avg. cost: Rs.{{$fv->vendor->average_cost}} / {{$fv->vendor->average_cost_type}}
                                                </div>
                                            </div>
                                            </a>  
                                            <a href="{{route('user.delete_favourites',['id'=>$fv->id])}}" class="fav-remove"><i class="ion-android-close"></i></a>
                                        </div>
                                </div>
                            </div>
                          @endforeach                        
                        </div>
                        @else
                        <p>No vendors saved in favourite list.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{asset('assets/public/datatable/datatables.min.js')}}"></script>
<script type="text/javascript">
	$('#favourites').DataTable();
</script>
@endsection
@section('styles')
<link href="{{asset('assets/public/datatable/datatables.min.css')}}" rel="stylesheet" />
@endsection


