@extends('layouts.public.index')
@section('content')
<section class="signup-page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="signup-form">
                    <form id="register-form" method="post" action="{{route('vendor.step1')}}">
                        {{ csrf_field() }}
                        <h3 class="color1">Enter Verification Code</h3>
                        <div class="form-group">
                            <input type="text" name="code" id="code" class="form-control" placeholder="Verification Code">
                            <span class="text-danger">
                                <strong id="code-error"></strong>
                            </span>
                        </div>    
                        <div class="form-group">
                            <button class="btn btn-block btn1" id="submitBtn" type="submit">Activate Account</button>
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
       $("#register-form").validate({
           ignore: [],
            rules: {               
               code: {
                   required: true,
                  
               }         
            },         
               
            messages: {
                code: {
                    required: "Please provide a Verification Code",
                    minlength: "Your password must be at least 8 characters long"
                }         

            },
            errorPlacement: function(error, element){              
                error.appendTo( element.parent("div") ); 
            },
            submitHandler: function(form) {
              $("#submitBtn").html("Loading <i class='ion-load-d'></i>").attr("disabled","disabled");
              $.ajax({
                   url: form.action,
                   type: form.method,
                   data: $(form).serialize(),
                   dataType:'json',
                   success: function(data) { 
                   $('#submitBtn').html('Register').removeAttr("disabled");                
                        if(data.errors){
                          $.each(data.errors, function(key,value) {
                               toastr.error(value);
                           });                       
                        }
                        if(data.success){
                            $('#register-form')[0].reset();
                            toastr.success(data.message);
                            window.location.replace("{{route('vendor.step2')}}");

                        }
                   },
                   error: function(jqXHR, exception) {
                        toastr.error("Some Error Occured Please Try Again");
                        console.log(jqXHR, exception);
                        $('#submitBtn').html('Register').removeAttr("disabled");                

                   }          
               });
           }
        });

      

    });
</script>
@endsection