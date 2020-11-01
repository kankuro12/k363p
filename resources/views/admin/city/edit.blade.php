@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit City</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.post_edit_city',['id'=>$city->id])}}" id="editCity">
                    @csrf
                    <div class="card-body">                                
                        <div class="form-group">
                            <label for="name">City Name</label>                        
                            <input type="text" class="form-control" id="name" placeholder="City Name" name="name" value="{{$city->name}}">
                        </div>
                        <div class="form-group">
                            <label for="code">Country</label>                        
                            <select name="country_id" class="form-control" id="country">
                                <option value="" disabled="" selected="">Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" {{$city->state->country_id==$country->id?'selected':''}}>{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>    

                        <div class="form-group">
                            <label for="code">State</label>                        
                            <select name="state_id" id="state" class="form-control">
                            	<option value="">Select State</option>
                            	@foreach($states as $state)
                            	<option value="{{$state->id}}" {{$city->state_id==$state->id?'selected':''}}>{{$state->name}}</option>
                            	@endforeach
                            </select>
                        </div>                                           
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script type="text/javascript">
    $("#editCity").validate({
        rules: {
            name: "required",                
            state_id: "required",            
        },
        messages: {
            name: "Please enter country name",
            state_id: "Please select state",
        }
    });
    $(document).on('change','#country',function(){
        var country_id=$(this).val();
        generateState(country_id);
        

    });
    function generateState(cid){
        $.ajax({
            type: "get",
            url: "/admin/country/"+cid+"/states",
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $("body").addClass('loading');    
            },
            success: function (data){
                $("body").removeClass('loading'); 
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
</script>
@endsection

