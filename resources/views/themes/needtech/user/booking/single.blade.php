@extends('themes.needtech.layout')
@section('meta')
    <meta name="theme-color" content="#494676" />
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('assets\public\css\userdashboard.css')}}">
@endsection
@section('subtitle','User Profile')
@section('subtitle_color','#494676')
@section('content')
@include('themes.needtech.user.snippets.header')
<section class="dashboard-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="dashboard-sidebar d-none d-lg-block sticky-top" style="top:100px !important">
                    @include('themes.needtech.user.snippets.sidebar')

                </div>
            </div>
            <div class="col-lg-9">
                <div class="dashboard-content-wrapper p-4">
                    <h4 class="mb-3 color1 font-weight-bold"><a href="{{route('n.user.booking')}}">Bookings</a> / Booking - #{{$code}}</h4>
                    <div id="message"></div>
                    <div id="content">
                        @if($booking!=null)

                            @php
                                $room=$booking->room;
                            @endphp
                            <div class="row">
                                <div class="col-lg-4">
                                    <img class="img-fluid" src="{{asset('uploads/vendor/roomphotos/'.$room->roomphotos[0]->image)}}" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <h2>
                                        {{$room->name}}
                                    </h2>
                                    <h6>
                                        {{$room->vendor->name}}
                                        @if ($room->vendor->location)
                                            {{$room->vendor->location->name!=null?' ,'.$room->vendor->location->name:""}}
                                        @endif
                                    </h6>
                                    <hr>
                                    <div>
                                        <table class="">
                                            <tr>
                                                <td class="text-right">
                                                    <strong>Start From : </strong>
                                                </td>
                                                <td>
                                                    {{$booking->check_in_time}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">
                                                    <strong>Payment Method : </strong>
                                                </td>
                                                <td>
                                                    {{($booking->type==2?'Online Payment('.$booking->payment->provider.')':'Pay At Hotel')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">
                                                    <strong>Payment Status : </strong>
                                                </td>
                                                <td>
                                                    {{$booking->payment_status}}
                                                </td>
                                            </tr>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        @else
                            <h4 class="text-center m-0 m-md-4 text-danger" >No Booking Was Found With Booking ID #{{$code}}</h4>
                        @endif
                    </div>

            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
    <script>
        function changeProfile() {
        $('#pf-pic').click();
    }
    $('#pf-pic').change(function () {
        if ($(this).val() != '') {
            $('.dash-profile-img').addClass('blink_me');
            upload(this);
        }
    });
    function upload(img) {

            var form_data = new FormData();
            form_data.append('file', img.files[0]);
            form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: "{{route('user.change_profile_pic')}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    $("body").removeClass('loading');
                    $('#profile_img').attr('src', '{{asset('uploads/user/profile_img/200x200/')}}/' + data.profile_img);
                    $('.dash-profile-img').removeClass('blink_me');

                    toastr.success(data.message);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
    }


    </script>
@endsection
