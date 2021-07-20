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
                <div class="dashboard-content-wrapper p-4 mb-3">
                    <h4 class="mb-3 color1 font-weight-bold"><a href="{{route('n.user.booking')}}">Bookings</a> / Booking - #{{$code}}</h4>
                    <div id="message"></div>
                    <div id="content">

                    </div>

                </div>
                @if($booking!=null)

                @php
                    $room=$booking->room;
                @endphp
                <div class="row">
                    <div class="col-lg-4">
                        <img class="img-fluid w-100" src="{{asset('uploads/vendor/roomphotos/'.$room->roomphotos[0]->image)}}" alt="">
                    </div>
                    <div class="col-lg-8">
                        <div class=" booking">
                            <div class="title">
                                {{$room->name}}
                            </div>
                            <div class="vendor">
                                 {{$room->vendor->name}}
                                 @if ($room->vendor->location)
                                     {{$room->vendor->location->name!=null?' ,'.$room->vendor->location->name:""}}
                                 @endif
                            </div>
                             <div style="height:2px;background:#f1f1f1;margin:2px 0px;"></div>
                             <div>
                                 <div class="row">
                                     <div class="col-lg-6">
                                         <div class="section-title"> <i class="fas fa-calendar-day"></i> {{$booking->check_in_time}}</div>
                                         {{-- <div class="section-text">{</div> --}}
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="section-title"> <i class="fas fa-rupee-sign"></i> {{($booking->type==2?'Online Payment('.$booking->payment->provider.')':'Pay At Hotel')}} </div>
                                         {{-- <div class="section-text"></div> --}}
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="section-title"> <i class="fas fa-circle" style="color:{{$booking->payment_status!='paid'?'#FE7768':'#6fff6f'}}"></i> {{$booking->payment_status}} </div>
                                         {{-- <div class="section-text">{{$booking->payment_status}}</div> --}}
                                     </div>
                                     <div class="col-lg-6">
                                         @php
                                            $text='';
                                            $color='';
                                             if($booking->booking_status=='pending'){
                                                $text='<i class="fas fa-clock"></i>';
                                                $color="#FFC000";
                                             }elseif($booking->booking_status='confirmed'){
                                                $text='<i class="fas fa-check-circle"></i>';
                                                $color="#65CDCE";
                                             }elseif($booking->booking_status='completed'){
                                                $text='<i class="fas fa-check-double"></i>';
                                                $color="#99CC94";
                                             }elseif($booking->booking_status='rejected'){
                                                $text='<i class="fas fa-times-circle"></i>';
                                                $color="#FE0606";
                                             }


                                         @endphp
                                         <div class="section-title" style="color:{{$color}};">

                                            {!!$text!!}


                                             {{$booking->booking_status}}
                                        </div>
                                         {{-- <div class="section-text"></div> --}}
                                     </div>
                                 </div>
                                 {{-- <div class="text-left">
                                     <a href="{{route('n.user.singlebooking',$booking->booking_id)}}" class="btn btn-primary btn-sm mt-1"> View Detail</a>
                                 </div> --}}

                             </div>
                        </div>
                        {{-- <h2>
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

                        </div> --}}
                    </div>
                </div>
            @else
                <h4 class="text-center m-0 m-md-4 text-danger" >No Booking Was Found With Booking ID #{{$code}}</h4>
            @endif
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
                url: "{{route('n.user.changepic')}}",
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
