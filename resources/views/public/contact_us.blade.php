@extends('layouts.public.index')
@section('content')
<section class="page_banner">
    <div class="container">
        <h1>Contact Us</h1>
    </div>
</section>
<section class="contact-section">
    <div class="container">
        <div class="contact-wrapper">
            <h3 class="text-center">We would love to hear from you</h3>
            <div class="row">
                <div class="col-md-8">
                    <div class="contact-form">
                        <form id="contact_us" action="{{route('contactus')}}" method="post">
                        	@csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone number">
                            </div>
                            <div class="form-group">
                                <label for="phone">Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter your subject">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" rows="5" class="form-control" placeholder="Write your message"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn1 btn-block mt-4">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-information">
                        <p><i class="color-primary ion-android-mail"></i> info@haamrotrip.com</p>    
                        <p><i class="color-primary ion-android-call"></i> +977 9842086201</p>   
                        <p><i class="color-primary ion-android-pin"></i> Janapath Marg, Biratnagar</p>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
 $("#contact_us").validate({
    ignore: [],
     rules: {
        name: {
            required: true,
            minlength: 4
        },
        email: {
            required: true,
            email: true
        },
        subject:{
            required:true,
        },
        phone: {
             required: true,
             number: true,
             minlength: 10,
             maxlength: 10
        },
        message:{
     	    required:true
     	  }
        },         
        
     messages: {
         name: {
             required: "Please enter name",
             minlength: "Your name must consist of at least 4 characters"
         },
         phone: {
         	required: "Please provide contact number",
         	minlength: "Contact must be 10 digits",
         	maxlength: "Contact must not be more than 10 digits"
         },
         subject:{
             required:"Please enter subject",
         },
         email:{
             required:"Please enter email address",
             email:"Please enter valid email address"
         },
         message: {
             required: "Please enter message ",        
         }
     },
     errorPlacement: function(error, element) { 
        
         error.appendTo( element.parent("div") ); 
     },
     submitHandler: function(form) {
       $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                $('#contact_us')[0].reset(); 
                 if(response.success){
                   alert("Thank You.");
                 }else{
                   alert("Sorry");
                 }
            }            
        });
    }
 });
 

 </script>
@endsection