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
                <div class="dashboard-content-wrapper mb-3 p-4">
                    <h4 class="mb-3 color1 font-weight-bold">Referal Program</h4>
                    <div id="message"></div>
                    <div id="content">
                        <div >

                                    <input onclick="copyLink()" id="ref_link" style="width:100%;padding:20px;color:#4BB543;font-weight:600;border:#4BB543 1px solid;background:rgba(75, 181, 67,0.2);text-align:center;" title="Copy Link" value="{{url('')}}?ref_id={{$user->id}}">

                        </div>
                        <style>
                            @media(max-width:768px){
                                .md-w-100{
                                    width:100%;

                                }
                            }
                        </style>
                        <div class="py-2 d-flex justify-content-center" style="flex-wrap: wrap;">
                            <button class="btn btn-secondary mx-0 mx-md-2 mb-2 md-w-100" style="background:#4BB543;border:none" onclick="copyLink()">Copy Link</button>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{url('')}}?ref_id={{$user->id}}" target="_blank" class="btn btn-secondary mx-0 mx-md-2 mb-2 md-w-100" style="background:#0E8CF1;border:none" >Share on Facebook</a>
                            <a class="btn btn-secondary mx-0 mx-md-2 mb-2 md-w-100" style="background:#1DA1F2;border:none;color:white;" >Share on Twitter</a>

                        </div>
                        @if (Auth::guard()->user()->myReferalCount()>0)
                        <hr>
                        <h4>My Referals ({{Auth::guard()->user()->myReferalCount()}})</h4>
                        <hr>
                        <div class="row m-0">

                            @foreach (Auth::guard()->user()->myReferals() as $referal)
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-4 col-md-5 p-1">
                                            <img src="{{asset($referal->profile_img)}}" alt="" class="w-100">
                                        </div>
                                        <div class="col-8 col-md-7 p-1 pt-2">
                                            <b>{{$referal->fname}}</b> <br>
                                            <b>{{$referal->lname}}</b> <br>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
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

    function copyLink(){
        document.getElementById('ref_link').select();
        document.execCommand('copy');
        toastr.success("Link Copied");
    }
</script>


@endsection

@section('onload')


@endsection
