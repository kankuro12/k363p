@extends('layouts.vendor.index_auth')
@section('content')
<section class="v-center w-100">
    <div class="logo text-center pb-1">
        <img src="{{asset('assets/public/img/logo.png')}}" style="max-width:250px;">
    </div>
    <div class="container">
        <div class="">
            <div class="mx-auto">

                <div class="p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="signup-form">
                    <form id="register-form" method="post" action="{{route('vendor.step3')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{-- <h3 class="text-center ">Add A Profile Image</h3> --}}
                        <div class="form-group">
                            <div style="position: relative">
                                <div class="text-center">
                                    <input onchange="loadImage(this)" style="display:none;" name="image" type="file" id="gal"
                                        accept="image/*"  required/>
                                    <img src="/images/add_profile.png" alt="..." id="gal_img"
                                        onclick="document.getElementById('gal').click();" style="max-width:300px;">
                                </div>
                                <div style="position: absolute;top:0px;right:0px;">
                                    <span class="btn btn-danger" onclick="
                                                                        document.getElementById('gal').value = null;
                                                                        document.getElementById('gal_img').src='/images/add_profile.png';
                                                                        ">Clear</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-primary" id="submitBtn" type="submit">Next</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">


        function loadImage(input) {
            console.log(input);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#gal_img').attr('src', e.target.result);
                }
                var FileSize = input.files[0].size / 1024;
                if (FileSize > 3072) {
                    alert('Image Size Cannot Be Greater than 3mb');
                    document.getElementById('gal_img').src = '/images/add_profile.png';
                    input.value = null;
                    console.log(input.files);
                } else {

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        }


</script>
@endsection
