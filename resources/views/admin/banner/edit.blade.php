@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{route('admin.banners')}}">Banners</a> / Edit Banner</h5>
            </div>
            <div class="card-body">
               <form action="{{route('admin.banners.edit',['banner'=>$banner->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="caption">Caption</label>
                        <input type="text" value="{{$banner->caption}}" name="caption" id="caption" class="form-control" placeholder="Enter Caption">
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" value="{{$banner->link}}" name="link" id="link" class="form-control" placeholder="Enter link like /vendor/ab" required>
                    </div>
                    <hr>
                    <div class="py-2">
                        <h6>
                            <input type="checkbox" value="1" {{$banner->show_button==1?"checked":""}} name="show_button" id="show_button" class="mr-2" onchange="
                                if(this.checked){
                                    $('#btn_detail').removeClass('d-none');
                                }else{
                                    $('#btn_detail').addClass('d-none');
                                }
                            "> Show Button
                        </h6>
                    </div>

                    <div class="row {{$banner->show_button==0?"d-none":""}}" id="btn_detail">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="button_text">Button Text</label>
                                <input type="text" name="button_text" id="button_text" class="form-control" placeholder="Enter Button Text">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div>
                        @php
                            $i=0;
                        @endphp
                            <label for="position">Banner Position</label>
                        <select name="position" id="position" class="form-control">
                            @foreach ($positions as $position)
                                <option {{$banner->position==$i?"checked":""}} value="{{$i++}}" >
                                    {{$position}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="py-2">
                        <h6>
                            Images
                        </h6>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label for="">for large screen</label>
                            <input type="file" accept='image/*' name="image" class="dropify" data-default-file="{{asset($banner->image)}}" >
                        </div>
                        <div class="col-md-4">
                            <label for="">for small screen</label>
                            <input type="file" accept='image/*' name="mobile_image" class="dropify" data-default-file="{{asset($banner->mobile_image)}}">
                        </div>
                    </div>
                    <div class="py-2">
                        <button class="btn btn-primary">Save Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" />
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
<script>
    var drEvent = $('.dropify').dropify();
</script>
@endsection