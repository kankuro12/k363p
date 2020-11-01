<div class="row">
  <div class="col-md-12 mx-auto">
    <div class="card">
      <div class="card-header">
        <h5>Privacy Policy</h5>
      </div>
      <div class="card-body">
        <form id="privacy-policy-form" method="post" action="">
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Check In Time</label>
                        <input type="text" name="check_in_time" class="timepicker form-control" placeholder="Check In Time" value="{{$policies?$policies->check_in_time:''}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Check Out Time</label>
                        <input type="text" name="check_out_time" class="timepicker form-control" placeholder="Check Out Time" value="{{$policies?$policies->check_out_time:''}}">
                    </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Check In Check Out Policy</label>
                          <textarea class="form-control" placeholder="Enter Check In CheckOut Policy" name="check_in_out_policy">{{$policies?$policies->check_in_out_policy:''}}</textarea>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Cancellation Policy</label>
                          <textarea class="form-control" placeholder="Enter Cancellation Policy" name="cancelation_policy">{{$policies?$policies->cancelation_policy:''}}</textarea>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Extra Bed Policy</label>
                          <textarea class="form-control" placeholder="Enter Extra Bed Policy" name="extra_bed_policy">{{$policies?$policies->extra_bed_policy:''}}</textarea>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Payment Mode</label>
                          <textarea class="form-control" placeholder="Enter Payment Mode" name="payment_mode">{{$policies?$policies->payment_mode:''}}</textarea>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Details</label>
                          <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" value="Mike" name="description">{{$policies?$policies->description:''}}</textarea>
                      </div>
                  </div>
              </div>
              <div class="text-center">
                  <button type="submit" class="btn btn-info btn-fill btn-wd">Update Policy</button>
              </div>
              <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
     $("#privacy-policy-form").validate({
         ignore: [],
          rules: {
             check_in_out_policy: {
                 required: true,
                 minlength: 4
             },
             cancelation_policy: {
                 required: true,
                 minlength: 4
             },
             extra_bed_policy: {
                 required: true,
                 minlength: 4
             },
             payment_mode: {
                 required: true,
                 minlength: 4
             },           
             description:{
                required:true
              },
             }, 
                  
             
          messages: {
              check_in_out_policy: {
                  required: "Please enter check in out policy name",
                  minlength: "Your check in out policy must consist of at least 4 characters"
              },
              cancelation_policy: {
                  required: "Please enter cancelation policy name",
                  minlength: "Your cancelation policy must consist of at least 4 characters"
              },
              extra_bed_policy: {
                  required: "Please enter extra bed policy name",
                  minlength: "Your extra bed policy must consist of at least 4 characters"
              },
              payment_mode: {
                required: "Please enter extra bed policy name",
                  minlength: "Your extra bed policy must consist of at least 4 characters"
              },
              description: {
                  required: "Please enter description ",        
              },
          },
          errorPlacement: function(error, element){              
              error.appendTo( element.parent("div") ); 
          },
          submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response){                    
                      if(response.errors){                        
                        for (var error in response.errors){
                          toastr.warning(response.errors[error]);
                        }
                      } 
                      if(response.success){
                        $('#privacy-policy-form')[0].reset();
                        toastr.success(response.message); 
                        loadData();
                      }else{
                        console.log("Sorry");
                      }
                  }            
             });
        }
      });
  });
</script>