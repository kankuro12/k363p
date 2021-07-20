@extends('themes.needtech.layout')
@section('meta')
    <meta name="theme-color" content="#494676" />
    <meta property="og:url"           content="{{Request::url()}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Your Website Title" />
    <meta property="og:description"   content="Your description" />
    <meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />
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
                    <h4 class="mb-3 color1 font-weight-bold">Profile</h4>
                    <div id="message"></div>
                    <div id="content"></div>
                    <div>
                        <form class="profile-form" id="user-profile-form" method="post" action="{{route('n.user.updateprofile')}}">
                            @csrf
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="fname" class="form-control" placeholder="Your First Name" value="{{$user->fname}}">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lname" class="form-control" placeholder="Your Last Name" value="{{$user->lname}}">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="mobile_number" class="form-control" placeholder="Your Phone Number" value="{{$user->mobile_number}}">
                            </div>
                            @php
                                $countries=\App\Model\Vendor\Country::all();
                                $states=\App\Model\Vendor\State::all();
                                $cities=\App\Model\Vendor\City::all();
                            @endphp
                            {{-- <div class="form-group">
                                <label>Country</label>
                                <select name="country_id" id="country" class="form-control">
                                    <option value="">Select country</option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}" @if($user->city_id!='')
                                                                {{$user->city->state->country_id==$country->id?'selected':''}}
                                                                @endif>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <select name="state_id" id="state" class="form-control">
                                    <option value="-1">Please Select A State</option>

                                    @foreach($states as $state)
                                    <option value="{{$state->id}}"

                                     {{$user->city->state_id==$state->id?'selected':''}}
                                    >{{$state->name}}</option>
                                    @endforeach

                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label>City</label>
                                <select name="city_id" id="city" class="form-control">
                                    <option value="-1">Please Select A City</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{$user->city_id==$city->id?'selected':''}} >{{$city->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Your Address" value="{{$user->location?$user->location:old('location')}}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn1 px-4">Update</button>
                            </div>
                        </form>
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


    </script>
@endsection
