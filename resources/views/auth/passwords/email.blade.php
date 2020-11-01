@extends('layouts.public.index')

@section('content')
<div class="login-page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="login-form">
                    <form method="POST" action="{{ url('password/email') }}">
                        @csrf
                        <div id="statusBox"></div>
                        <h3 class="color1 mb-4">Forgot Password</h3>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{old('email')}}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn1" id="submitBtn">Send Password Reset Link</button>
                        </div>                         
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection
