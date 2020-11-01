<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>Manage Packages<a href="{{route('vendor.get_create_rooms')}}" class="btn btn-success pull-right">Add New Package</a></h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="rooms">
              <thead>
                  <tr>
                      <th>S.N.</th>
                      <th>Name</th>
                      <th>Type</th>
                      <th>Price</th>
                      <th>Discount</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($rooms as $index=>$room)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$room->name}}</td>
                  <td>{{$room->roomtype->name}}</td>
                  <td>{{$room->price}}</td>
                  <td>{{$room->discount?$room->discount:'0'}}</td>
                  <td>{{$room->status}}</td>
                  <th>
                    <a href="{{route('vendor.get_edit_rooms',['id'=>$room->id])}}" class="btn btn-success btn-sm"><i class="ion-ios-compose-outline"></i></a>
                    <button class="btn btn-primary btn-sm delete_room" data-room-id="{{$room->id}}"><i class="ion-ios-trash-outline"></i></button>
                  </th>
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
$('#rooms').DataTable();
</script>