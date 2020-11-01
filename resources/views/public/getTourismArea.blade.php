@extends('layouts.public.index')
@section('content')
<section class="places-banner-section img-wrapper" data-background="{{asset('uploads/tourismareas/'.$tourismArea->featured_image)}}">
    <div class="container">
        <h1>{{$tourismArea->name}}</h1>
    </div>
</section>
<section class="places-detail-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
               <div class="places-detail-wrapper">
                    {!!$tourismArea->description!!}
               </div>
            </div>
            @if($othertourismAreas->count()>0)
            <div class="col-md-4">
                <div class="places-sidebar">
                    <div class="d-p-heading">
                        <h2>Other Places</h2>
                    </div>
                    @foreach($othertourismAreas as $ot)
                    <a href="{{route('public.get_tourism_area',['slug'=>$ot->slug])}}">
	                    <div class="places-sidebar-item">
	                        <div class="d-flex">
	                            <div class="r-c-img-wrapper">
	                                <img src="{{asset('uploads/tourismareas/'.$ot->featured_image)}}">
	                            </div>
	                            <div class="r-c-detail-wrapper">
	                                <div class="r-c-title">{{str_limit($ot->name,30,'...')}}</div>
	                                <div class="r-c-loc"><i class="ion-android-pin"></i> {{$ot->location}}</div>
	                            </div>
	                        </div>
	                    </div>
	                </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection