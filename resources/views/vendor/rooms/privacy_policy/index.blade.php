@extends('layouts.vendor.index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Add Privacy Policy</h4>
                    </div>
                    <div class="content">
                        <ul class="nav nav-pills">
                          
                        </ul>
                        <hr>
                        <div id="statusBox"></div>
                        <form method="post" action="{{route('vendor.post_privacy_policy_rooms',['id'=>$id])}}" id="privacy-policy-form"  enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Check In Time</label>
                                        <input type="text" name="check_in_time" class="form-control" placeholder="Check In Time">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Check Out Time</label>
                                        <input type="text" name="check_out_time" class="form-control" placeholder="Check Out Time">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Check In/Check Out Policy</label>
                                        <input type="text" name="check_out_policy" class="form-control" placeholder="Check Out Policy">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Cancellation Policy</label>
                                    <textarea class="form-control" placeholder="Cancellation Policy" name="cancelation_policy"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label>Children/Bed Policy</label>
                                    <textarea class="form-control" placeholder="Children/Bed Policy" name="children_bed_policy"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Pet Policy</label>
                                    <textarea class="form-control" placeholder="Pet Policy" name="pet_policy"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label>Group Policy</label>
                                    <textarea class="form-control" placeholder="Group Policy" name="group_policy"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Card Accept</label>
                                    <select class="form-control" name="isCardAccepted">
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Payment Policy</label>
                                    <textarea class="form-control" name="payment_policy" placeholder="Payment Policy"></textarea>
                                </div>
                            </div>

                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </div>
                        </form>        
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('assets/vendor/assets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $("#privacy-policy-form").validate({
           ignore: [],
            rules: {
               check_in_time: {
                   required: true,                   
               },
               check_out_time: {
                   required: true,                  
               },
               check_out_policy: {
                   required: true
               },
               cancelation_policy:{
                   required:true,
               },                         
               children_bed_policy:{
                required:true
               },
               pet_policy: {
                    required: true
               },
               group_policy: {
                   required:true
               },
               payment_policy:{
                required:true
               },              
            },         
               
            messages: {
                check_in_time: {
                    required: "Please Check In Time",
                },
                check_out_time: {
                    required: "Please provide check out time",
                },
                check_out_policy:{
                    required:"Please enter check out policy",
                },
                cancelation_policy:{
                    required:"Please enter cancelation policy",                    
                },
                children_bed_policy:{                   
                    required:"Please enter children bed policy"
                },
                pet_policy:{
                    required:"Please enter pet policy"
                },
                group_policy: {
                    required: "Please enter group policy ",        
                },
                payment_policy:{
                    required: "Please enter payment policy ",                       
                }

            },
            errorPlacement: function(error, element){              
                error.appendTo( element.parent("div") ); 
            },
            submitHandler: function(form) {
              $.ajax({
                   url: form.action,
                   type: form.method,
                   data: $(form).serialize(),
                   dataType:'json',
                   success: function(response) {
                       $('#privacy-policy-form')[0].reset();
                        if(response.errors){                            
                            for (var error in response.errors) {
                               toastr.warning(response.errors[error]);                             
                            }
                        } 
                        if(response.success){
                          toastr.success(response.message);     
                          location.href=response.redirect_url;
                        }else{
                          console.log("Sorry");
                        }
                   }            
               });
           }
        });

    });
</script>
@endsection