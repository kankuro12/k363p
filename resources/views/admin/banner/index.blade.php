@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Banners
                  <a href="{{route('admin.banners.add')}}" class="btn btn-success pull-right">Add Banner</a>
                </h5>
            </div>
            <div class="card-body">
                <div class="py-4">
                    @foreach ($banners as $key=>$banner_list)
                        <h4 class="font-weight-bold">
                            {{$positions[$key]}}
                        </h4>
                        <hr>
                    
                        @foreach ($banner_list as $banner)
                            @include('admin.banner.single',['banner'=>$banner]);
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
