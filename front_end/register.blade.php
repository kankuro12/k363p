@extends('layouts.public.index')
@section('content')
<section id="login_page">
	<div class="container">
		<div class="row">
			<div class="col-6 mx-auto">
                <div id="statusBox">
                </div>
				<form id="register-form" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name">
	                    <span class="text-danger">
	                        <strong id="fname-error"></strong>
	                    </span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name">
                        <span class="text-danger">
                            <strong id="lname-error"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
                        <span class="text-danger">
                            <strong id="email-error"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number">
                        <span class="text-danger">
                            <strong id="mobile_number-error"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        <span class="text-danger">
                            <strong id="password-error"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" id="cpassword" class="form-control" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button type="submit">Register</button>
                                <hr />
                                <div class="text-success" id="register-status"></div>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
	$("#register-form").on('submit',function(e){
		e.preventDefault();
		$('#fname-error').html("");
		$('#lname-error').html("");
        $('#email-error').html("");
        $('#password-error').html("");
        $('#mobile_number-error').html("");
		// taking data from form...
		var token=$("input[name=_token]").val();
		var fname=$("input[name=fname]").val();
		var lname=$("input[name=lname]").val();
		var email=$("input[name=email]").val();
		var password=$("input[name=password]").val();
		var mobile_number=$("input[name=mobile_number]").val();
		var password_confirmation=$("input[name=password_confirmation]").val();
		// Collect the data
		var data={
		    _token:token,
		    email:email,
		    password:password,
		    password_confirmation:password_confirmation,
		    fname:fname,
		    lname:lname,
		    mobile_number:mobile_number,
		};
		// Send Request to Server 
        $.ajax({
            type: "post",
            url: "{{route('user.postRegister')}}",
            data: data,
            cache: false,
            success: function (data)
            {            	
                if(data.errors){
                    if(data.errors.fname){
                        $('#fname-error' ).html(data.errors.fname[0] );
                    }
                    if(data.errors.lname){
                        $('#lname-error' ).html(data.errors.lname[0] );
                    }
                    if(data.errors.email){
                        $('#email-error' ).html(data.errors.email[0] );
                    }
                    if(data.errors.password){
                        $('#password-error' ).html(data.errors.password[0] );
                    }
                    if(data.errors.mobile_number){
                        $('#mobile_number-error' ).html(data.errors.mobile_number[0] );
                    }
                }
                if(data.success){
                    $('#register-form')[0].reset();
                    var statusBoxContent='<div class="alert alert-success">'+data.message+'</div>';
                    $("#statusBox").html(statusBoxContent);
                }
            },
            error: function (data){
                alert('Fail to run Login..');
            }
        });
	});       
</script>
@endsection