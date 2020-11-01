@extends('layouts.public.index')
@section('content')
<section id="login_page">
	<div class="container">
		<div class="row">
			<div class="col-6 mx-auto">
                <div id="statusBox"></div>
                @include('layouts.public.snippets.error')
                @include('layouts.public.snippets.msg')
				<form id="login-form">
				  @csrf
				  <div class="form-group">
				    <label for="email">Email address:</label>
				    <input type="email" class="form-control" id="email" name="email">
                    <span class="text-danger">
                        <strong id="email-error"></strong>
                    </span>
				  </div>
				  <div class="form-group">
				    <label for="pwd">Password:</label>
				    <input type="password" class="form-control" id="pwd" name="password">
                    <span class="text-danger">
                        <strong id="password-error"></strong>
                    </span>
				  </div>
				  <div class="checkbox">
				    <label><input type="checkbox" name="remeber"> Remember me</label>
				  </div>
				  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="{{route('fpass')}}">Forgot Password</a>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).on('submit','#login-form',function(e){
		e.preventDefault();
        $('#email-error').html("");
        $('#password-error').html("");

		var token=$("input[name=_token]").val();
        var email=$("input[name=email]").val();
        var password=$("input[name=password]").val();
        var remeber=$("input[name=remeber]").val();
        var data={
            _token:token,
            email:email,
            password:password,
            remeber:remeber,
        };
        console.log(data);
        // Ajax Post 
        $.ajax({
            type: "post",
            url: "{{route('user.postLogin')}}",
            data: data,
            cache: false,
            success: function (data)
            {
                console.log(data);
                if(data.errors){                    
                    if(data.errors.email){
                        $('#email-error' ).html(data.errors.email[0] );
                    }
                    if(data.errors.password){
                        $('#password-error' ).html(data.errors.password[0] );
                    }                    
                }
                if(data.success){
                    location.href = data.redirect_url;
                }else{
                    var statusBoxContent='<div class="alert alert-danger">'+data.message+'</div>';
                    $("#statusBox").html(statusBoxContent);
                }
            },
            error: function (data){
                alert('Fail to run Login..');
            }
        });
        return false;
	});
</script>
@endsection