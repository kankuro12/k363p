@extends('layouts.vendor.index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Add Room</h4>
                    </div>
                    <div class="content">
                        <ul class="nav nav-pills">
                         
                        </ul>
                        <hr>
                        <div id="statusBox"></div>
                        <form action="{{route('vendor.post_photos_rooms',['id'=>$id])}}" class="dropzone">
                          @csrf
                        </form>
                    <button class="btn btn-primary" style="margin:10px 0;">Save</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/vendor/assets/js/dropzone.js')}}"></script>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/assets/css/dropzone.css')}}">
@endsection