@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>New City</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.post_create_city')}}" id="addCity" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">                                
                        <div class="form-group">
                            <label for="name">City Name</label>                        
                            <input type="text" class="form-control" id="name" placeholder="City Name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="code">Country</label>                        
                            <select class="form-control" id="country">
                                <option value="" disabled="" selected="">Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>    

                        <div class="form-group">
                            <label for="code">State</label>                        
                            <select name="state_id" id="state" class="form-control">
                            	<option value="">Select State</option>
                            </select>
                        </div>   
                        <div class="form-group">
                            <label for="code">Icon</label>                        
                            <input type="file" name="icon" id="icon" required accept="image/*" class="form-control">
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
    $("#addCity").validate({
        rules: {
            name: "required",                
            country_code: "required",
            country_currency:"required",
        },
        messages: {
            name: "Please enter country name",
            country_code: "Please enter country code",
            country_currency:"Please enter country currency"
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
                //$("body").addClass('loading');    
            },
            success: function (data){
                //$("body").removeClass('loading'); 
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

