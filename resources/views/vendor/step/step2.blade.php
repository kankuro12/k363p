@extends('layouts.public.index')
@section('content')
<section class="signup-page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto">

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
                    <form id="register-form" method="post" action="{{route('vendor.step2')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <h3 class="color1 ">Add A Cover Photo</h3>
                        <div class="form-group">
                            <div style="position: relative">
                                <div>
                                    <input onchange="loadImage(this)" style="display:none;" name="image" type="file" id="gal"
                                        accept="image/*"  required/>
                                    <img src="/images/add_cover.png" alt="..." id="gal_img"
                                        onclick="document.getElementById('gal').click();" style="width: 100%;">
                                </div>
                                <div style="position: absolute;top:0px;right:0px;">
                                    <span class="btn btn-danger" onclick="
                                                                        document.getElementById('gal').value = null;
                                                                        document.getElementById('gal_img').src='/images/add_cover.png';
                                                                        ">Clear</span>
                                </div>
                            </div>
                        </div>    
                        <div class="form-group">
                            <button class="btn btn-block btn1" id="submitBtn" type="submit">Next</button>
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
                    document.getElementById('gal_img').src = '/images/add_cover.png';
                    input.value = null;
                    console.log(input.files);
                } else {

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        }

    
</script>
@endsection