<form id="editMealForm" action="{{route('vendor.post_edit_meal')}}" method="post" enctype="multipart/form-data">
<input type="hidden" name="vendor_id" value="{{$vendor->id}}" required="">
<input type="hidden" name="id" value="{{$meal->id}}" required="">
@csrf
<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{$meal->name}}">
</div>
<div class="form-group">
    <label>Price</label>
    <input type="text" name="price" class="form-control" value="{{$meal->price}}">
</div>
<div class="form-group">
    <label>Status</label>
    <select class="form-control" name="status">
        <option value="active" {{$meal->status=="active"?'selected':''}}>Active</option>
        <option value="inactive" {{$meal->status=="inactive"?'selected':''}}>Inactive</option>
    </select>               
</div>
</div>

<!-- Modal footer -->
<div class="modal-footer">
  <button type="submit" class="btn btn-primary">Submit</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>