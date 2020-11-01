  <form action="{{route('vendor.post_amenities_rooms',['id'=>1])}}" id="editAmenities" method="post" enctype="multipart/form-data">
      @csrf
    @foreach($amenities as $amenity)
    <input type="hidden" name="amenity_id[]" value="{{$amenity->id}}" required="">
    <div class="row">
      <div class="col-md-6">                  
          <input type="text" name="amenity[]" class="form-control" placeholder="Amenities" value="{{$amenity->amenity}}">
      </div>                              
      <div class="col-md-4">                  
          <select class="form-control" name="status[]">
              <option value="active" {{$amenity->status=='active'?'selected':''}}>Active</option>
              <option value="inactive" {{$amenity->status=='inactive'?'selected':''}}>Inactive</option>
          </select>
      </div>
      <div class="col-md-2">
          <button class="btn btn-danger delete" type="button" data-id="{{$amenity->id}}"><i class="ti-trash"></i></button>
      </div>
    </div>  
    @endforeach                        

<!-- Modal footer -->
<div class="modal-footer">
  <button type="submit" class="btn btn-primary">Submit</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</form>