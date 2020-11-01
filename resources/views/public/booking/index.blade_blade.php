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
          <div class="col-md-8">
             <div class="wizard-form-wrapper">
                 <div class="wizard-steps">
                    <div class="wizard-step active">
                        <span class="step-num">1</span>
                        <span class="step-title">Personal Information</span> 
                    </div>
                    <div class="wizard-step">
                        <span class="step-num">2</span>
                        <span class="step-title">Billing Details</span> 
                    </div>
                    <div class="wizard-step">
                        <span class="step-num">3</span>
                        <span class="step-title">Payment Method</span> 
                    </div>
                 </div>
                 <hr>
                 <div class="checkout-wizard-form">
                    <form id="checkout-from" method="post" action="{{route('booking_process_start_step_2')}}">
                    <input type="hidden" name="room_id" id="room_id" value="{{$room->id}}">
                    <input type="hidden" name="product_name" id="product_name" value="{{$room->vendor->name}}({{$room->name}})">
                    <input type="hidden" name="product_url" id="product_url" value="{{route('public.get_room',['vslug'=>$room->vendor->slug,'rslug'=>$room->slug])}}">
                    <input type="hidden" name="vendor_id" value="{{$hotel_detail->id}}">
                    <input type="hidden" name="check_in_time" value="{{$details['check_in_time']}}">
                    <input type="hidden" name="check_out_time" value="{{$details['check_out_time']}}">
                    <input type="hidden" name="adult" value="{{$details['num_of_adults']}}">
                    <input type="hidden" name="children" value="{{$details['num_of_childs']}}">
                    <input type="hidden" name="num_rooms" value="{{$details['num_rooms']}}">
                    <input type="hidden" name="price" id="price" value="{{$details['price']}}">
                    <input type="hidden" name="coupon_discount" value="{{$details['price']}}">
                    @if($coupon)
                        <input type="hidden" name="coupon_applied" value="{{$coupon->coupon_code}}">
                        <input type="hidden" name="coupon_id" value="{{$coupon->id}}">
                        @if($coupon->coupon_setting->discount_type==1)
                        <input type="hidden" name="discount_value" value="{{$coupon->coupon_setting->discount_value}}">
                        @else
                        <input type="hidden" name="discount_value" value="{{$details['price']*$coupon->coupon_setting->discount_percent/100}}">
                        @endif
                    @endif
                     <div class="personal-info c-w-f" id="personalInfo" data-step="1">
                         <div class="d-p-heading">
                             <h2>Personal Information</h2>
                         </div>                         
                             <div class="form-group">
                                 <label>First Name</label>
                                 <input type="text" name="fname" placeholder="First Name" class="form-control" value="{{$user->vendoruser->fname}}" id="first_name">
                             </div>
                             <div class="form-group">
                                 <label>Last Name</label>
                                 <input type="text" name="lname" placeholder="Last Name" class="form-control" value="{{$user->vendoruser->lname}}" id="last_name">
                             </div>
                             <div class="form-group">
                                 <label>Email</label>
                                 <input type="email" name="email" placeholder="Email" class="form-control" value="{{$user->email}}">
                             </div>
                             <div class="form-group">
                                 <label>Phone Number</label>
                                 <input type="text" name="pnumber" placeholder="Phone Number" class="form-control" value="{{$user->vendoruser->mobile_number}}">
                             </div>
                             <div class="form-group">
                                 <a href="#billingInfo" class="btn btn1 py-2 pl-4 pr-4">Billing Info <i class="ion-chevron-right"></i></a>
                             </div>                         
                     </div>
                     <div class="billing-info c-w-f" id="billingInfo" data-step="2">
                         <div class="d-p-heading">
                             <h2>Billing Information</h2>
                         </div>
                         
                             <div class="form-group">
                                 <label>Country</label>
                                 <select class="form-control" id="country">
                                     <option value="">Select Country</option>
                                     @foreach($countries as $country)
                                     <option value="{{$country->id}}">{{$country->name}}</option>
                                     @endforeach                                       
                                 </select>                                                                
                             </div>
                             <div class="form-group">
                                 <label>State</label>
                                 <select class="form-control" id="state">
                                     <option value="">Select State</option>
                                 </select>
                             </div>
                             <div class="form-group">
                                 <label>City</label>
                                 <select class="form-control" id="city" name="city_id">
                                     <option value="">Select City</option>
                                 </select>
                             </div>
                             <div class="form-group">
                                 <label>Address</label>
                                 <input type="text" name="address" placeholder="Address" class="form-control">
                             </div>
                             <div class="form-group">
                                <a href="#personalInfo" class="btn btn-secondary py-2 pl-4 pr-4"><i class="ion-chevron-left"></i> Personal Info</a>
                                <a href="#paymentInfo" class="btn btn1 py-2 pl-4 pr-4 float-right">Payment Method <i class="ion-chevron-right"></i></a>
                             </div>
                        
                     </div>
                     <div class="payment-info c-w-f" id="paymentInfo" data-step="3">
                         <div class="d-p-heading">
                             <h2>Payment Method</h2>
                         </div>                         
                             <div class="form-group mt-4">
                                 <input type="radio" name="pmethod" id="p_at_hotel" value="1">
                                 <label for="p_at_hotel">Pay @ Hotel</label>
                             </div>
                             <div class="form-group mt-4">
                                 <input type="radio" name="pmethod" id="online_payment" value="2">
                                 <label for="online_payment">Online Payment</label>
                             </div>
                             <div class="form-group">
                                <label for="additionalinfo">Additional Requests (optional)</label>
                                 <textarea name="additionalinfo" id="additionalinfo" class="form-control" rows="4" placeholder="Add your additional requests here..."></textarea>
                             </div>
                             <div class="form-group">
                                 <a href="#billingInfo" class="btn btn-secondary py-2 pl-4 pr-4"><i class="ion-chevron-left"></i> Billing Info</a>
                                 <a href="#" id="checkoutBtn" class="btn btn1 pl-4 pr-4 py-2 float-right">Confirm Booking <i class="ion-chevron-right"></i></a>
                             </div>
                         
                     </div>
                    </form>
                 </div>
             </div>
             @if($meals->count()>0)
             <div class="hotel-menu">
                <div class="d-p-heading">
                    <h2>Menu</h2>
                </div>
                <a href="#" class="mt-3 font-weight-bold" data-toggle="collapse" data-target="#check_menu">Check Menu <i class="ion-chevron-right"></i></a>
                <div id="check_menu" class="collapse pt-4">
                    <div class="check_menu_item mb-3 font-weight-bold">
                        <span>Item</span>
                        <span>Price</span>
                        <span>Quantity</span>
                    </div>
                    @foreach($meals as $meal)
                    <form id="meal-form">
                        <input type="hidden" name="meal_id[]" value="{{$meal->id}}">
                        <div class="check_menu_item">
                            <span>
                               {{$meal->name}}
                            </span>
                            <span>
                                Rs. {{$meal->price}}
                            </span>
                            <span>
                                <input type="number" name="meal_value[]" min="0" max="10" value="0">
                            </span>
                        </div>
                    </form>
                    @endforeach
                </div>
             </div>
             @endif
          </div>
          <div class="col-md-4">
              <div class="booking-detail-wrapper">
                <div class="d-p-heading">
                    <h2>Your booking detail</h2>
                </div>
                <div class="mt-4">
                    <h5 class="color1">{{$hotel_detail->name}}</h5>
                    <p><i class="ion-android-pin"></i> {{$hotel_detail->location->name}}</p>
                </div>
                <hr>
                <div class="ch-date">
                    <div class="checkin">
                        <div class="ch-title">check-in</div>
                        {{\Carbon\Carbon::parse($details['check_in_time'])->toFormattedDateString()}}
                        <div class="d-flex align-items-center">
                            <div class="ch-date-date mr-1">
                                24
                            </div>
                            <div class="ch-day-year">
                                <div class="ch-day">THU</div>
                                <div class="ch-year">JAN 2019</div>
                            </div>
                        </div>
                    </div>
                    <div class="checkout">
                        <div class="ch-title">check-out</div>
                        {{\Carbon\Carbon::parse($details['check_out_time'])->toFormattedDateString()}}
                        <div class="d-flex align-items-center">
                            <div class="ch-date-date mr-1">
                                26
                            </div>
                            <div class="ch-day-year">
                                <div class="ch-day">THU</div>
                                <div class="ch-year">JAN 2019</div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="b-detail-breakdown">
                    <p><span id="room_name"> {{$room->name}}</span> <span class="float-right">x {{$details['num_rooms']}}</span></p>
                    <p>Adult <span class="float-right">x {{$details['num_of_adults']}}</span></p>
                    <p>Child <span class="float-right">x {{$details['num_of_childs']}}</span></p>
                    <p>Day(s) <span class="float-right">x {{ Carbon\Carbon::parse($details['check_out_time'])->diffInDays(Carbon\Carbon::parse($details['check_in_time']))}}</span></p>
                </div>
                <hr>
                <div class="b-total-price font-weight-bold">
                    <div class="total-price-title">Total Price</div>
                    <div class="total-price color1">Rs. {{$details['price']}}</div>
                    @if($coupon)
                        @if($coupon->coupon_setting->discount_type==1)
                        {{$coupon->coupon_setting->discount_value}}
                        @else
                        {{$details['price']*$coupon->coupon_setting->discount_percent/100}}
                        @endif
                    @endif
                </div>
              </div>
              @if($room->coupon_enabled && !Session::get('coupon_applied'))
              <form id="apply_coupon" action="{{route('bookings.apply_coupon')}}">
                <input type="hidden" name="room_id" value="{{$room->id}}" required="">
                  <div class="apply-coupon">
                      <div class="d-p-heading">
                          <h2>Apply Coupon</h2>
                      </div>
                      <input type="text" name="coupon" class="form-control mb-2" placeholder="Apply coupon here">
                      <button class="btn btn-block btn-success" type="submit">Apply</button>
                  </div>
              </form>
              @endif
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
        @foreach($pmethods as $pm)
            <button class="btn btn-default" id="{{strtolower($pm->name)}}pay">Pay With {{$pm->name}}</button>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).on('change','#country',function(){
        var country_id=$(this).val();
        $("#state").empty();
        $("#city").empty();
        generateState(country_id);
    });
    $(document).on('change','#state',function(){
        var state_id=$(this).val();
        generateCity(state_id);
    });
    function generateState(cid){
        $.ajax({
            type: "get",
            url: "/country/"+cid+"/states",
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                // $("body").addClass('loading');    
            },
            success: function (data){
                // $("body").removeClass('loading'); 
                $("#state").empty();
                $('#state').append($('<option>',{value:' ', text:'Select State'}));

                $.each(data, function(index, state) {                                 
                    $('#state').append($('<option>',{value:state.id, text:state.name}));
                });
            },
            error:function(data){
                console.log(data);
            }
        });
    }
    function generateCity(cid){
        $.ajax({
            type: "get",
            url: "/state/"+cid+"/cities",
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                //$("body").addClass('loading');    
            },
            success: function (data){
                //$("body").removeClass('loading'); 
                $("#city").empty();
                $('#city').append($('<option>',{value:' ', text:'Select City'}));

                $.each(data, function(index, state) {                                 
                    $('#city').append($('<option>',{value:state.id, text:state.name}));
                });
            },
            error:function(data){
                console.log(data);
            }
        });
    }
    $(document).on('submit','#apply_coupon',function(e){
        e.preventDefault();
        $(this).find("button[type='submit']").attr('disabled',true);
        var data=$(this).serialize();
        var url=$(this).attr('action');
        $.ajax({
            type: "post",
            url: url,
            dataType: 'json',
            data:data,
            beforeSend: function() {
                // $("body").addClass('loading');    
            },
            success: function (data){
               if(data.success==1){
                $("#apply_coupon").find("input[type='text']").attr('disabled',true);
                $("#apply_coupon").find("button[type='submit']").text('Coupon Applied');
                toastr.success(data.msg);   
               }else if(data.success==0){
                $("#apply_coupon").find("button[type='submit']").attr('disabled',false);
                toastr.warning(data.msg);   
               }            
            },
            error:function(data){
                console.log(data);
            }
        });
    });
    $(document).on('click','.ph_trigger',function(e){
        e.preventDefault();
        var data=$("#checkout-from,#meal-form").serialize();
        var url=$("#checkout-from").attr('action');
        $.ajax({
            type: "post",
            url: url,
            data:data,
            beforeSend: function() {
                $("body").addClass('loading');    
            },
            success: function (data){
                $("body").removeClass('loading');    
                toastr.success(data.msg); 
                location.href = data.redirect_url;
            },
            error:function(data){
                console.log(data);
            }
        });

    });
    $(document).on('click','.online_payment_trigger',function(e){        
        $('#online_payment_mdl').modal('show');       
    })
    $(document).ready(function(){
        $("input[name=pmethod]").change(function(){
            if($(this).val()==1){
                $("#checkoutBtn").removeClass("online_payment_trigger").addClass("ph_trigger");
            }
            else if($(this).val()==2){
                $("#checkoutBtn").addClass("online_payment_trigger").removeClass("ph_trigger");
            }
        })
    })


</script>
<script src="https://khalti.com/static/khalti-checkout.js"></script>
<script>
    var config = {
        "publicKey": "{{$khalti->mode=='live'?$khalti->live_public_key:$khalti->test_public_key}}",
        "productIdentity":document.getElementById("room_id").value,
        "productName":document.getElementById("product_name").value,
        "productUrl": document.getElementById("product_url").value,
        "eventHandler": {
            onSuccess (payload) { 
            var data=$("#checkout-from,#meal-form").serialize()+"&idx="+payload.idx+"&token="+payload.token+"&amount="+payload.amount;
               document.body.classList.add("loading","transparent");
                $.post("{{route('user.pay_with_khalti')}}",data,function(data){
                        if(data.success){
                           document.body.classList.remove("loading","transparent");
                            toastr.success(data.msg); 
                            location.href = data.redirect_url;
                        }
                    });               
            },
            onError (error) {
                toastr.info(error);                     
                location.reload();
            },
            onClose () {
            }
        }
    };
    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("khaltipay");
    btn.onclick = function () {
        var org_name="Org name";
        var ammount=document.getElementById('price').value;
        checkout.show({amount: ammount*100});
    }
</script>
@endsection
