<form action="{{route('admin.post_edit_vendor_photo',['slug'=>$vendor->slug])}}" method="post" enctype="multipart/form-data">
<input type="hidden" name="vendor_id" value="{{$vendor->id}}" required="">
<input type="hidden" name="id" value="{{$gallery->id}}" required="">
@csrf
<div class="form-group">
    <label>Photo</label>
    <input type="file" name="photo" class="form-control">
    <div>
        <img src="{{asset('uploads/vendor/gallery/'.$gallery->photo)}}" class="img-responsive" style="padding: 20px; 0">
    </div>
</div>
<div class="form-group">
    <label>Caption</label>
    <input type="text" name="caption" class="form-control" value="{{$gallery->caption}}">
</div>
<div class="form-group">
    <label>Status</label>
    <select class="form-control" name="status">
        <option value="active" {{$vendor->status=="active"?'selected':''}}>Active</option>
        <option value="inactive" {{$vendor->status=="inactive"?'selected':''}}>Inactive</option>
    </select>               
</div>
</div>

<!-- Modal footer -->
<div class="modal-footer">
  <button type="submit" class="btn btn-primary">Submit</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>