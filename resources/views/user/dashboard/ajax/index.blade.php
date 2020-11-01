<form class="profile-form" id="user-profile-form" method="post" action="{{route('user.update_profile')}}">
    @csrf
    <div class="form-group">
        <label>First Name</label>
        <input type="text" name="fname" class="form-control" placeholder="Your First Name" value="{{$user->fname}}">  
    </div>
    <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="lname" class="form-control" placeholder="Your Last Name" value="{{$user->lname}}">  
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="mobile_number" class="form-control" placeholder="Your Phone Number" value="{{$user->mobile_number}}">  
    </div>
    <div class="form-group">
        <label>Country</label>
        <select name="country_id" id="country" class="form-control">
            <option value="">Select country</option>
            @foreach($countries as $country)
            <option value="{{$country->id}}" @if($user->city_id!='')
                                        {{$user->city->state->country_id==$country->id?'selected':''}}
                                        @endif>{{$country->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>State</label>
        <select name="state_id" id="state" class="form-control">
            @if($user->city_id!='')
            @foreach($user->city->state->country->states as $state)
            <option value="{{$state->id}}"
            
             {{$user->city->state_id==$state->id?'selected':''}}
            >{{$state->name}}</option>
            @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label>City</label>
        <select name="city_id" id="city" class="form-control">
            @if($user->city_id!='')
            @foreach($user->city->state->cities as $city)
            <option value="{{$city->id}}" {{$user->city_id==$city->id?'selected':''}} >{{$city->name}}</option>
            @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label>Address</label>
        <input type="text" name="address" class="form-control" placeholder="Your Address" value="{{$user->location?$user->location:old('location')}}">  
    </div>
    <div class="form-group">
        <button class="btn btn1 px-4">Save</button>
        <a href="javascript:history.back()" class="btn btn-success my-2 my-sm-0 text-white">Cancel</a>
    </div>
</form>
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
</script>