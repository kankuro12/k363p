@extends('layouts.public.index')

@section('content')
<div class="login-page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="login-form">
                    <h3 class="color1 mb-4">Reset Password</h3>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('password/reset') }}">
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

                        <div class="form-group">
                            <button type="submit" class="btn btn1">
                                    Reset Password
                            </button>                            
                        </div>
                    </form>
                 </div>
             </div>
         </div>
     </div>
 </div>

@endsection
