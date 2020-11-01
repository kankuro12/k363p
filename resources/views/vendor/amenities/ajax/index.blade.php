<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5> Amenities</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="amenities" data-page-length='5'>
              <thead>
                <tr>
                  <th>S.N.</th>
                  <th>Amenity</th>
                  <th>Icon</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
               @foreach($amenities as $index=>$amenity)
               @php
               $checked=auth()->user()->vendor->amenities->where('id',$amenity->id)->first();                  
               @endphp
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$amenity->name}}</td>
                  <td>                         
                    <img src="{{asset('uploads/vendor/amenities/icons/'.$amenity->icon)}}" class="img-responsive" width="50px;">
                  </td>
                  <td>
                     <input type="checkbox" name=""  class="amenity" data-aid="{{$amenity->id}}" {{$checked?'checked':''}}>                         
                  </td>
                </tr>
                @endforeach                     
              </tbody>
            </table> 
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$('#amenities').DataTable();
</script>