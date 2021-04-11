<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>{{ env('APP_NAME', 'laravel') }}</title>
</head>

<body>


    <div class="m-0">
        <div class="" style="
    height: 100vh;
    /* background: red; */
    background: #4AA9E1;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #5B86E5, #4AA9E1);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to bottom, #5B86E5, #4AA9E1); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">

        </div>
        <div class=" pl-0 min-h-100" style="
    position: absolute;
    top: 0px;
    left: 0px;
    right: 0px;
    bottom:0px;
    display:flex;
    justify-content: center;
    align-items: center;
">

            <div class="text-white text-center">
                <div class="p-3">
                    <a href="/">
                        <img src="{{ asset('assets/public/img/logo.png') }}" style="max-width:250px;">
                    </a>
                </div>
                <h2>
                    Thank You for Your Request.
                </h2>
                <h4>

                    We Will in Touch back Soon.
                </h4>
                <hr style="height: 1px;color:white;background:white;">
                <div class="">
                    <a href="/" class="btn btn-link text-white" style="font-size:25px;ont-weight: 600;">Browse Website</a>
                    <a href="{{route('vendor.getLogin')}}" class="btn btn-link text-white" style="font-size:25px;ont-weight: 600;">Driving Center Login</a>
                </div>
            </div>

        </div>
</body>

</html>
