@extends('layouts.public.index')

@section('content')
@section('style')
    <link rel="stylesheet" href="{{asset('assets\public\css\userdashboard.css')}}">
@endsection
@include('user.nav')
<section class="dashboard-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-sidebar sticky-top">
                    @include('user.sidebar')
                </div>
            </div>
            <div class="col-md-9">
                <div class="dashboard-content-wrapper p-4">
                    <h4 class="mb-3 color1 font-weight-bold">Profile</h4>
                    <div id="message"></div>
                    <div id="content"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">

        loadData();
        function loadData(){
            $.ajax({
                type: "get",
                url: "{{route('user.profile')}}",
                data: "",
                cache: false,
                success: function (data){
                    $("#content").html(data);
                },
                error:function(data){
                    console.log(data);
                }
            });
        }
        $(document).on('submit','#user-profile-form',function(e){
            e.preventDefault();
            var data=$(this).serialize();
            var url=$(this).attr('action');
            $.ajax({
                type: "post",
                url:url,
                data: data,
                cache: false,
                beforeSend: function() {
                    $("body").addClass('loading');
                },
                success: function (data){
                    $("#message").html('');
                    $("#message").removeClass('alert alert-danger');
                    $("body").removeClass('loading');
                    if(data.errors){
                        $("#message").addClass('alert alert-danger');
                        $.each(data.errors, function(key,value) {
                             $('#message').append('<li>'+value+'</li>');
                         });
                    }else{
                        toastr.success(data.message);
                        loadData();
                    }
                },
                error:function(data){
                    console.log(data);
                }
            });
        });
</script>
<script type="text/javascript">
  function changeProfile() {
      $('#pf-pic').click();
  }
  $('#pf-pic').change(function () {
      if ($(this).val() != '') {
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
                  toastr.success(data.message);
              },
              error: function (xhr, status, error) {
                  console.log(xhr.responseText);
              }
          });
  }
</script>
@endsection
