<table class="table table-bordered" id="galleries">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Caption</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($galleries as $gallery)
      <tr>
        <td>
            <img src="{{asset('uploads/vendor/gallery/'.$gallery->photo)}}" class="img-fluid" style="width: 150px;">  
        </td>
        <td>{{$gallery->caption}}</td>
        <td>{{$gallery->status}}</td>
        <td>
            <button class="btn btn-sm btn-success edit-btn" data-p-id="{{$gallery->id}}"><i class="ti-pencil"></i></button>
            <button class="btn btn-sm btn-danger" onclick="deletePhoto({{$gallery->id}});"><i class="ti-trash"></i></button>
        </td>
      </tr>
      @endforeach
    </tbody>
</table>
<script>
$('#galleries').DataTable({
    pageLength: 5,
});
</script> 



