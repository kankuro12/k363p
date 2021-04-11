@extends('layouts.vendor.index_auth')
@section('content')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
        

    </style>
    <div class="v-center w-100">
        <div class="logo text-center pb-3">
            <a href="/">
                <img src="{{ asset('assets/public/img/logo.png') }}" style="max-width:250px;">
            </a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-11 mx-auto">
                    <div class="login-form p-4" style="box-shadow:0px 0px 10px 0px #616161;border-radius:10px;">
                        <form id="login-form" class="log-form" method="post" action="{{ route('vendor.request') }}">
                            @csrf
                            <div id="statusBox"></div>
                            <h3 class="mb-4 text-center" style="font-weight:700;">Request A Call</h3>
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Driving Center Name" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="address" placeholder="Driving Center Address" class="form-control"
                                    required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <input type="email" name="email" placeholder="Enter Email Address"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <input type="number" min="9800000000" name="phone" placeholder="Enter Phone Number"
                                            class="form-control" required>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="owner" placeholder="Owner's Name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-block btn-primary" id="submitBtn">Request a Call</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {


        });

    </script>
@endsection
