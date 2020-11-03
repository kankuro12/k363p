@extends('layouts.public.index')
@section('content')
    <div class="page-banner">
        <div class="page-banner-content">
            <div class="container">
                <h1>Checkout page</h1>
            </div>
        </div>
    </div>
    <div class="checkout-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 p-0">
					<div class="bg-white  p-2">	
						<hr>
                        <form id="checkout-from" method="post" action="{{ route('booking_process_start_step_2') }}">
                            @csrf

							<input type="hidden" name="room_id" id="room_id" value="{{ $room->id }}">
							<input type="hidden" name="product_name" id="product_name"
								value="{{ $room->vendor->name }}({{ $room->name }})">
							<input type="hidden" name="product_url" id="product_url"
								value="{{ route('public.get_room', ['vslug' => $room->vendor->slug, 'rslug' => $room->slug]) }}">
							<input type="hidden" name="vendor_id" value="{{ $hotel_detail->id }}">
							<input type="hidden" name="check_in_time" value="{{ $check_in_time }}">
							{{-- <input type="hidden" name="check_out_time"
								value="{{ $details['check_out_time'] }}">
                                --}}
                            <input type="hidden" name="adult" value="1">
                            <input type="hidden" name="children" value="0">
                            <input type="hidden" name="num_rooms" value="1">
							<input type="hidden" name="price" id="price" value="{{$room->discount==0? $room->price:$room->getNewPrice() }}">
	
							<div class="d-p-heading">
								<h2>Personal Information</h2>
							</div>
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
	
	
							<hr>
							<div class="d-p-heading">
								<h2>Payment Method</h2>
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
								<a id="checkoutBtn" class="btn btn1 pl-4 pr-4 py-2 ">Confirm Booking <i
										class="ion-chevron-right"></i></a>
							</div>
	
						</form>
					</div>
                </div>

            <div class="col-md-4 mt-3 mt-md-0 p-0 ">
                <div class="booking-detail-wrapper mr-md-2 ml-md-2">
                    <div class="d-p-heading">
                        <h2>Your booking detail</h2>
                    </div>
                    <div class="mt-4">
                        <h5 class="color1">{{ $hotel_detail->name }}</h5>
                        <p><i class="ion-android-pin"></i> {{ $hotel_detail->location->name }}</p>
                    </div>
                    <hr>
                    <div class="ch-date">
                        <div class="checkin">
                            <div class="ch-title">Start Date</div>
                            @php
                                $startdate=\Carbon\Carbon::parse($check_in_time);
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

                    </div>
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
            e.preventDefault();
            var data = $("#checkout-from").serialize();
            var url = $("#checkout-from").attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: data,
                beforeSend: function() {
                    //$("body").addClass('loading');    
                },
                success: function(data) {
                    //$("body").removeClass('loading');    
                    toastr.success(data.msg);
                    location.href = data.redirect_url;
                },
                error: function(data) {
                    console.log(data);
                }
            });

        });
        $(document).on('click', '.online_payment_trigger', function(e) {
            $('#online_payment_mdl').modal('show');
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
                "productName": document.getElementById("product_name").value,
                "productUrl": document.getElementById("product_url").value,
                "eventHandler": {
                    onSuccess(payload) {
                        var data = $("#checkout-from,#meal-form").serialize() + "&idx=" + payload.idx + "&token=" +
                            payload.token + "&amount=" + payload.amount;
                        document.body.classList.add("loading", "transparent");
                        $.post("{{ route('user.pay_with_khalti') }}", data, function(data) {
                            if (data.success) {
                                document.body.classList.remove("loading", "transparent");
                                toastr.success(data.msg);
                                location.href = data.redirect_url;
                            }
                        });
                    },
                    onError(error) {
                        toastr.info(error);
                        location.reload();
                    },
                    onClose() {}
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
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $(".meal-qty").click(function() {
                var meal_item = $(this).parents(".check_menu_item");
                var meal_item_index = meal_item.data('index');
                var meal_qty = $(this).val();
                var meal_price = meal_item.find('.meal-price').text();
                var meal_name = meal_item.find('.meal-name').text();
                var additional_price = 0;

                $(".check_menu_item").each(function() {
                    additional_price = ($(this).find('meal-price').text()) * ($(this).find(
                        'meal-qty').val());
                })
                alert(additional_price);

                if (meal_qty > 0) {
                    if ($('.added-meals p').length > 0) {
                        var index_count = 0;
                        var that;
                        $(".added-meals p").each(function() {

                            if ($(this).data('index') == meal_item_index) {
                                index_count = 1;
                                that = $(this);
                                return false;
                            }
                        });
                        if (index_count) {
                            that.find('.added-meal-qty').text(meal_qty);
                        } else {
                            $(".added-meals").append('<p data-index="' + meal_item_index + '">' +
                                meal_name +
                                '<span class="float-right">x <span class="added-meal-qty">' + meal_qty +
                                '</span></span></p>');
                        }

                    } else {
                        $(".added-meals").append('<p data-index="' + meal_item_index + '">' + meal_name +
                            '<span class="float-right">x <span class="added-meal-qty">' + meal_qty +
                            '</span></span></p>');

                    }

                    //alert(added_meal_index)
                } else {
                    if (meal_qty == 0 && $('.added-meals p').length > 0) {
                        var index_count = 0;
                        var that;
                        $(".added-meals p").each(function() {

                            if ($(this).data('index') == meal_item_index) {
                                index_count = 1;
                                that = $(this);
                                return false;
                            }
                        });
                        if (index_count) {
                            that.remove();
                        }
                    }
                }

            })
        })

    </script> --}}

@endsection
