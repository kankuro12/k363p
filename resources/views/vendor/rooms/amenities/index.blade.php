@extends('layouts.vendor.index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Add Amenities</h4>
                    </div>
                    <div class="content">
                      <ul class="nav nav-pills">
                        <li role="presentation" class="active"><a href="{{route('vendor.get_edit_rooms',['id'=>$id])}}">Basic Details</a></li>
                        <li role="presentation"><a href="">Amenities</a></li>
                        <li role="presentation"><a href="#">Photos</a></li>
                        <li role="presentation"><a href="#">Privacy Policy</a></li>
                        <li role="presentation"><a href="#">Payment Option</a></li>
                      </ul>
                        <div id="statusBox"></div>
                          <form action="{{route('vendor.post_amenities_rooms',['id'=>1])}}" id="addAmenities" method="post" enctype="multipart/form-data">
                              @csrf
                            <div class="row">
                              <div class="col-md-6">                  
                                  <input type="text" name="amenity[]" class="form-control" placeholder="Amenities">
                              </div>                              
                              <div class="col-md-4">                  
                                  <select class="form-control" name="status[]">
                                      <option value="active">Active</option>
                                      <option value="inactive">Inactive</option>
                                  </select>
                              </div>
                              <div class="col-md-2">
                                  <button class="btn btn-success addMore" type="button"><i class="ti-plus"></i></button>
                              </div>
                            </div>  
                            <div class="newField"></div>
                        

                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
<script type="text/javascript">
    var maxGroup =20;
    var i=1;        
    //add more fields group
    $(".addMore").click(function(){         
        if(i < maxGroup){
            var fieldHTML =

           '<div class="row" id="f-'+i+'">'+
                '<div class="col-md-6">'+               
                    '<input type="text" name="amenity[]" placeholder="Amenities" class="form-control">'+
                '</div>'+                
                '<div class="col-md-4">'+               
                    '<select class="form-control" name="status[]">'+
                        '<option value="active">Active</option>'+
                        '<option value="inactive">Inactive</option>'+
                    '</select>'+
                '</div>'+
                '<div class="col-md-2">'+
                    '<button class="btn btn-danger addMore" onclick="remove('+i+')" type="button"><i class="ti-minus"></i></button>'+
                '</div>'+
            '</div>'; 
            
            $(".newField").append(fieldHTML);
            i++;
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });     
    
    function remove(a){
        $("#f-"+a).remove();
        i--;
    }
    //ameenity
    $(document).on('submit','#addAmenities',function(e){
      e.preventDefault();
      var data=$(this).serialize();
      var url=$(this).attr('action');
      var method=$(this).attr('method');
      $.ajax({
           url: url,
           type: method,
           data: data,
           success: function(response) {                       
              $("#addAmenities")[0].reset();
              location.href=response.redirect_url;
           }            
       });
      
    })
</script>
@endsection