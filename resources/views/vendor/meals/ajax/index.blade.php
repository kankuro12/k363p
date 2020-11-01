<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>Meals
        <a href="" class="btn btn-success pull-right" data-toggle="modal" data-target="#addMeal">Add New Meal</a></h5> 
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="meals">
              <thead>
                <tr>
                  <th>S.N.</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>  
              @foreach($meals as $index => $meal)
              <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$meal->name}}</td>
                  <td>{{$meal->price}}</td>
                  <td>
                   @if($meal->status=="active")
                   <span class="label label-success">Active</span>
                   @else
                   <span class="label label-info">Inactive</span>
                   @endif  
                 </td>
                  <td>
                    <button class="btn btn-sm btn-success btn-fill edit-btn" data-p-id="{{$meal->id}}"><i class="ion-ios-compose-outline"></i></button>
                    <button class="btn btn-sm btn-primary btn-fill" onclick="deleteMeal({{$meal->id}});"><i class="ion-ios-trash-outline"></i></button>
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
$('#meals').DataTable();
</script>