<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Area::Reset Password</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
    body {
        color: #999;
        background: url('https://coloredbrain.com/wp-content/uploads/2016/07/login-background.jpg');
        background-size: cover;        
        font-family: 'Varela Round', sans-serif;
    }
    .form-control {
        box-shadow: none;
        border-color: #ddd;
    }
    .form-control:focus {
        border-color: #4aba70; 
    }
    .login-form {
        width: 400px;
        margin: 0 auto;
        padding: 30px 0;
    }
    .login-form form {
        color: #434343;
        border-radius: 1px;
        margin-bottom: 15px;
        background: #fff;
        border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h4 {
        text-align: center;
        font-size: 22px;
        margin-bottom: 20px;
    }
    .login-form .avatar {
        color: #fff;
        margin: 0 auto 30px;
        text-align: center;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        z-index: 9;
        background: #4aba70;
        padding: 15px;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .login-form .avatar i {
        font-size: 62px;
    }
    .login-form .form-group {
        margin-bottom: 20px;
    }
    .login-form .form-control, .login-form .btn {
        min-height: 40px;
        border-radius: 2px; 
        transition: all 0.5s;
    }
    .login-form .close {
        position: absolute;
        top: 15px;
        right: 15px;
    }
    .login-form .btn {
        background: #4aba70;
        border: none;
        line-height: normal;
    }
    .login-form .btn:hover, .login-form .btn:focus {
        background: #42ae68;
    }
    .login-form .checkbox-inline {
        float: left;
    }
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .forgot-link {
        float: right;
    }
    .login-form .small {
        font-size: 13px;
    }
    .login-form a {
        color: #4aba70;
    }
</style>
</head>
<body>
<div class="login-form">
    <form action="{{ route('adminpasswordreset') }}" method="post">
        @csrf
        <div class="avatar"><i class="material-icons">fingerprint</i></div>
        <h4 class="modal-title">Reset Password</h4>
        @include('layouts.admin.snippets.error')
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="Email Address">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif                            
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif                           
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">                        
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-enter password" required>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
            
        </div>
        
        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Reset Password">              
    </form>         
</div>
</body>
</html>                                                                 