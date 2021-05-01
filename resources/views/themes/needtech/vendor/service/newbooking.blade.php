@extends('themes.needtech.layout')
@section('subtitle',"Checkout - ".$room->name)
@section('meta')
    <meta name="theme-color" content="#c22319" />
@endsection
@section('styles')

    <link rel="stylesheet" href="{{asset('assets\public\css\nouislider.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        .form-header{
            font-weight:700;
            font-size: 1.5rem;
        }

        @media(max-width:576px){
            .form-header{
                font-weight:700;
                font-size: 1.1rem;
            }
        }
    </style>
@endsection
@section('content')
    <div class="page-banner d-none d-md-block">
        <div class="page-banner-content py-2 py-md-5 mb-2 mb-md-3 " style="background:blue;color:white;text-align:center;">
            <div class="container">
                <h1 >Checkout page</h1>
            </div>
        </div>
    </div>
    <div class="mb-3 d-md-none d-flex" style="max-height: 150px;display:flex;align-items: flex-end;overflow:hidden">
        <img src="{{asset($room->roomphotos[0]->image)}}" alt="" class="w-100">
    </div>
    <div class="checkout-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7 ">
					<div class="bg-white  p-2 p-md-4 shadow mt-2 mt-md-0 mb-5 mb-md-0" >
                        <div class="d-p-heading">
                            <h2 class="form-header">Personal Information</h2>
                        </div>
						<hr>
                        <form id="checkout-from" method="post" action="{{ route('n.book') }}">
                            @csrf

							<input type="hidden" name="room_id" id="room_id" value="{{ $room->id }}">

							<input type="hidden" name="price" id="price" value="{{(round($room->discount==0? $room->price:$room->getNewPrice()) )}}">

                            @if (Auth::check())
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="fname" placeholder="First Name" class="form-control"
                                        value="{{ $user->vendoruser->fname }}" id="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" placeholder="Last Name" class="form-control"
                                        value="{{ $user->vendoruser->lname }}" id="last_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="Email" class="form-control"
                                        value="{{ $user->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="pnumber" placeholder="Phone Number" class="form-control"
                                        value="{{ $user->vendoruser->mobile_number }}" required>
                                </div>
                            @else
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="fname" placeholder="First Name" class="form-control"
                                        id="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" placeholder="Last Name" class="form-control"
                                        id="last_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="pnumber" id="pnumber" placeholder="Phone Number" class="form-control" required>
                                </div>
                                <div class="form-group" id="getOTP">
                                    <span class="btn btn-primary" onclick="getOTP()">
                                        Get OTP
                                    </span>
                                </div>
                                <div class="form-group d-none" id="verifyOTP">
                                    <div class="row m-0">
                                        <div class="col-md-9 p-1">
                                            <input type="number" name="otp" id="otp" placeholder="Enter Otp" class="form-control" required>
                                        </div>
                                        <div class="col-md-3 p-1">
                                            <span class="btn btn-primary" onclick="verifyOTP()">
                                                verify OTP
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            
                            @endif
							
                            <div id="second_stage" class="{{Auth::check()?'':'d-none'}}">

                                <div class="extrainfo d-none" >
                                    <input type="hidden" name="extrainfo" id="extrainfo">
                                </div>
    
                                <hr>
                                <div class="d-p-heading">
                                    <h2 class="form-header">Payment Method</h2>
                                </div>
                                <div class="form-group mt-4">
                                    <input type="radio" name="pmethod" id="p_at_hotel" value="1">
                                    <label for="p_at_hotel">Pay @ Vendor</label>
                                </div>
                                <div class="form-group mt-4">
                                    <input type="radio" name="pmethod" id="online_payment" value="2">
                                    <label for="online_payment">Online Payment</label>
                                </div>
                                <div class="form-group">
                                    <label for="additionalinfo">Additional Requests (optional)</label>
    
                                    <textarea name="additionalinfo" id="additionalinfo" class="form-control" rows="4"
                                        placeholder="Add your additional requests here..."></textarea>
                                </div>
                                <div class="form-group">
                                    <a id="checkoutBtn" class="btn btn1 pl-4 pr-4 py-2 text-white">Confirm Booking <i
                                            class="ion-chevron-right"></i></a>
                                </div>
                            </div>

						</form>
					</div>
                </div>

            <div class="col-md-5 mt-3 mt-md-0  ">
                <div class="booking-detail-wrapper mr-md-2 ml-md-2 shadow p-2 p-md-4 mb-3 mb-md-0 d-none d-md-block">
                    <div class="d-p-heading">
                        <h2 class="form-header">Your booking detail</h2>
                    </div>
                    <div class="mt-4">
                        <h5 class="color1">{{ $room->name }}</h5>
                        <h6 class="color1">{{ $room->vendor->name }}</h6>
                        <p><i class="ion-android-pin"></i> {{ $room->vendor->location->name }}</p>
                    </div>
                    {{-- <hr>
                    <div class="ch-date">
                        <div class="checkin">
                            <div class="ch-title">Start Date</div>
                            @php
                                $startdate=\Carbon\Carbon::parse($date);
                            @endphp

                            <div class="d-flex align-items-center">
                                <div class="ch-date-date mr-1">
                                    {{$startdate->day}}
                                </div>
                                <div class="ch-day-year">
                                    <div class="ch-day">{{$startdate->format('D')}}</div>
                                    <div class="ch-year">{{$startdate->format('M')}} {{$startdate->format('Y')}}</div>
                                </div>
                            </div>
                        </div>

                    </div> --}}
                    <hr>
                    <div class="b-total-price font-weight-bold">
                        <div class="total-price-title">Total Price</div>
                        <div class="total-price color1" data-org-price="{{$room->discount==0? $room->price:$room->getNewPrice() }}">Rs. <span
                                class="t-price-amount">{{$room->discount==0? $room->price:$room->getNewPrice() }}</span></div>
                    </div>
                </div>


            </div>
        </div>
        </div>
    </div>

    </div>
    </div>

    <div class="d-block d-md-none " style="box-shadow: 0px -1px 10px 0px rgb(185, 185, 185);position:fixed;z-index:999;bottom:0px;left:0px;right:0px;padding: 15px;background:white;">
        <div class="row">
            {{-- <div class="col-6">
                <div style="font-weight:700">
                    Start Date
                </div>
                <div style="font-weight:500;font-size:0.8rem;">
                    <div >{{$startdate->format('D')}}, {{$startdate->format('M')}} {{$startdate->format('Y')}} </div>

                </div>
            </div> --}}
            <div class="col-12  d-flex justify-content-between">
                <div style="font-weight:700 ">
                    Amount
                </div>
                <div style="font-weight:500;font-size:0.8rem;text-align:right;">
                    Rs. {{$room->discount==0? $room->price:$room->getNewPrice() }}
                 </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="online_payment_mdl">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Online Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($pmethods as $pm)
                        <button class="btn btn-default" id="{{ strtolower($pm->name) }}pay">Pay With
                            {{ $pm->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).on('click', '.ph_trigger', function(e) {
            document.getElementById('checkout-from').submit();

        });
        $(document).on('click', '.online_payment_trigger', function(e) {
            axios.get('{{route('n.auth_check')}}')
            .then(function(response){
                $('#online_payment_mdl').modal('show');
            });
            
        })
        $(document).ready(function() {
            $("input[name=pmethod]").change(function() {
                if ($(this).val() == 1) {
                    $("#checkoutBtn").removeClass("online_payment_trigger").addClass("ph_trigger");
                } else if ($(this).val() == 2) {
                    $("#checkoutBtn").addClass("online_payment_trigger").removeClass("ph_trigger");
                }
            })
        })

    </script>
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
    @if ($khalti != null)
        <script>
            var config = {
                "publicKey": "{{ $khalti->mode == 'live' ? $khalti->live_public_key : $khalti->test_public_key }}",
                "productIdentity": document.getElementById("room_id").value,
                "productName": "{{$room->name}}",
                "productUrl": "{{route('n.single_service',['r_slug'=>$room->slug,'v_slug'=>$room->vendor->slug])}}",
                "eventHandler": {
                    onSuccess(payload) {
                        console.log(payload);
                        axios.post("{{ route('n.verifyBooking') }}", payload)
                        .then(function(response){
                            console.log(response);
                            if(response.data.verified){
                                $('#online_payment_mdl').modal('hide');
                                $('#extrainfo').val(JSON.stringify(payload));
                                document.getElementById('checkout-from').submit();

                            }
                        })
                        .catch(function(error){
                            console.log(error.reponse);
                        })
                        // var data = $("#checkout-from,#meal-form").serialize() + "&idx=" + payload.idx + "&token=" +
                        //     payload.token + "&amount=" + payload.amount;
                        // document.body.classList.add("loading", "transparent");
                        // $.post("{{ route('n.verifyBooking') }}", payload, function(data) {
                        //     if (data.success) {
                        //         // document.body.classList.remove("loading", "transparent");
                        //         // toastr.success(data.msg);
                        //         // location.href = data.redirect_url;
                        //     }
                        // });
                    },
                    onError(error) {
                        toastr.info(error);
                        // location.reload();
                    },
                    onClose() {
                        $('#online_payment_mdl').modal('hide');
                    }
                }
            };
            var checkout = new KhaltiCheckout(config);
            var btn = document.getElementById("khaltipay");
            btn.onclick = function() {
                var org_name = "Org name";
                var ammount = document.getElementById('price').value;
                checkout.show({
                    amount: ammount * 100
                });
            }

        </script>
    @endif

    <script>
        function validateEmail(email) 
        {
            var re = /\S+@\S+\.\S+/;
            return re.test(email) ;
        }

        function validatePhone(phone){
            
            $f2s=phone.slice(0,2);
            console.log($f2s);
            return phone.length==10 && $f2s=="98";
        }
        function getOTP(){
            data={
                fname:$('#first_name').val(),
                lname:$('#last_name').val(),
                email:$('#email').val(),
                phone:$('#pnumber').val(),
            };
            validatePhone(data.phone);
            if(data.fname==""){
                alert('Please Enter First Name');
                return;
            }

            if(data.email=="" || !validateEmail(data.email) ){
                alert('Please Enter a valid Email Address');
                return;
            }

            if(!validatePhone(data.phone)){
                alert('Please Enter a valid Phone Number');
                return;
            }

            axios.post("{{route('n.getotp')}}",
                data
            )
            .then(function(res){
                $('#getOTP').remove();
                $('#verifyOTP').removeClass('d-none');

            })
            .catch(function(err){
                alert('Some Error Occured Please Try Again');
            });
        }
        function verifyOTP(){
            data={
                otp:$('#otp').val(),
                phone:$('#pnumber').val(),
            };
           

            if(!validatePhone(data.phone)){
                alert('Please Enter a valid Phone Number');
                return;
            }

            axios.post("{{route('n.verifyotp')}}",
                data
            )
            .then(function(res){
                $('#verifyOTP').remove()
                $('#second_stage').removeClass('d-none')
            })
            .catch(function(err){
                alert('Cannnot Verify Otp Please Try Again.');
            });
        }
    </script>


@endsection
