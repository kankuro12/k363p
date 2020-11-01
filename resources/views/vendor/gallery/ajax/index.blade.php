<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
      <h5> Manage Gallery
        <button class="btn btn-success pull-right" data-toggle="modal" data-target="#addPhoto">Add New Photo</button>
      </h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="gallery">
              <thead>
                  <tr>
                      <th>S.N.</th>
                      <th>Photo</th>
                      <th>Caption</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($galleries as $index=>$gallery)
                  <tr>
                    <td>{{$index+1}}</td>
                    <td>
                        <img src="{{asset('uploads/vendor/gallery/263x160/'.$gallery->photo)}}" class="img-responsive" style="max-width: 150px;">  
                    </td>
                    <td>{{$gallery->caption}}</td>
                    <td>
                      @if($gallery->status=="active")
                      <span class="label label-success">Active</span>
                      @else
                      <span class="label label-info">Inactive</span>
                      @endif   
                    </td>
                    <td>
                        <button class="btn btn-sm btn-success btn-fill edit-btn" data-p-id="{{$gallery->id}}"><i class="ion-ios-compose-outline"></i></button>
                        <button class="btn btn-sm btn-danger btn-fill" onclick="deletePhoto({{$gallery->id}});"><i class="ion-ios-trash-outline"></i></button>
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
$('#gallery').DataTable();
</script>