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
            <img src="{{ asset('assets/public/img/logo.png') }}" style="max-width:250px;">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-11 mx-auto">
                    <div class="login-form p-4" style="box-shadow:0px 0px 10px 0px #616161;border-radius:10px;">
                        <h3 class="text-center">
                            Thank You for Your Request. We Will in Touch back Soon.
                        </h3>

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
