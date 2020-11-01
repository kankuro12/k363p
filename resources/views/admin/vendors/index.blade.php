@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                 <h5>Vendors
                    <a href="{{route('admin.get_create_vendor')}}" class="pull-right btn-primary btn btn-success">Add New Vendor</a>
                </h5>
            </div>
            <div class="card-body">
                @include('layouts.admin.snippets.msg') 
                <div class="table-responsive">
                    <div class="panel panel-default">
                       <div class="panel-body">

                       </div>
                    </div>
                    <table id="" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>                                                                
                                <th>Address</th>
                                <th>Status</th>
                                <th>Verified</th> 
                                <th>Featured</th>                               
                                <th>Action</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vendors as $index=>$vendor)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$vendor->name}} <span class="badge badge-primary">{{$vendor->category->name}}</span></td>                             
                                <td>{{$vendor->location?$vendor->location->name:'N/A'}}</td>
                                <td>{{$vendor->user->active==1?'Active':'Inactive'}}</td>   
                                <td>
                                    <input type="checkbox" value="1" class="Verified" data-vid="{{$vendor->id}}" {{$vendor->verified==1?'checked':''}}>                                             
                                    
                                </td>           
                                <td>
                                    <select name="status" class="featured" data-vid="{{$vendor->id}}">
                                        <option value="">---</option>
                                        <option value="active" {{$vendor->featured=='active'?'selected':''}}>Active</option>
                                        <option value="inactive" {{$vendor->featured=='inactive'?'selected':''}}>Inactive</option>
                                        <option value="pending" {{$vendor->featured=='pending'?'selected':''}}>Pending</option>
                                    </select>
                                </td>                  
                                <td>
                                    <a href="{{route('admin.vendor',['slug'=>$vendor->slug])}}" class="btn btn-sm btn-primary"><i class="ion-ios-eye-outline"></i></a>
                                    <a href="{{route('admin.get_edit_vendor',['slug'=>$vendor->slug])}}" class="btn btn-sm btn-success"><i class="ion-ios-compose-outline"></i></a>
                                    <a href="{{route('admin.get_delete_vendor',['slug'=>$vendor->slug])}}" class="btn btn-sm btn-danger"><i class="ion-ios-trash-outline"></i></a>
                                </td>
                            </tr>
                            @endforeach    
                            </tbody>                        
                    </table>
                    <div class="text-center">
                        {{$vendors->links()}}
                    </div>
                </div>                   
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<link href="{{asset('assets/admin/assets/datatable/datatables.min.css')}}" rel="stylesheet" />
@endsection
@section('scripts')
<script src="{{asset('assets/admin/assets/datatable/datatables.min.js')}}"></script>
<script>
$('#vendors').DataTable();
$(document).on('change','.featured',function(e){
    e.preventDefault();
    var vid=$(this).attr('data-vid'); 
    var value=$(this).val();   
    $.ajax({
        type: "post",
        url: "{{route('admin.vendor.change_featured')}}",
        data: {vid:vid,value:value},
        cache: false,
        beforeSend: function() {
            //$("body").addClass('loading');    
        },
        success: function (data){
            //$("body").removeClass('loading'); 
            toastr.success(data.message);
        },
        error:function(data){
            console.log(data);
        }
    });    

});
$(document).on('change','.Verified',function(e){
    e.preventDefault();
    var vid=$(this).attr('data-vid');   
    $.ajax({
        type: "post",
        url: "{{route('admin.vendor.change_verified')}}",
        data: {vid:vid},
        cache: false,
        beforeSend: function() {
            $("body").addClass('loading');    
        },
        success: function (data){
            $("body").removeClass('loading'); 
            if(data.fs==1){
                $(this).prop('checked',true);
            }else{
                $(this).prop('checked',false);                
            }
            toastr.success(data.message);
        },
        error:function(data){
            console.log(data);
        }
    });    

});

</script>
<script type="text/javascript">
    $(document).on('change','#country',function(){
        var country_id=$(this).val();
        $("#state").empty();
        $("#city").empty();
        generateState(country_id);
    });
    $(document).on('change','#state',function(){
        var state_id=$(this).val();
        generateCity(state_id);
    });
    function generateState(cid){
        $.ajax({
            type: "get",
            url: "/country/"+cid+"/states",
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                // $("body").addClass('loading');    
            },
            success: function (data){
                // $("body").removeClass('loading'); 
                $("#state").empty();
                $('#state').append($('<option>',{value:' ', text:'Select State'}));

                $.each(data, function(index, state) {                                 
                    $('#state').append($('<option>',{value:state.id, text:state.name}));
                });
            },
            error:function(data){
                console.log(data);
            }
        });
    }
    function generateCity(cid){
        $.ajax({
            type: "get",
            url: "/state/"+cid+"/cities",
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                //$("body").addClass('loading');    
            },
            success: function (data){
                //$("body").removeClass('loading'); 
                $("#city").empty();
                $('#city').append($('<option>',{value:' ', text:'Select City'}));

                $.each(data, function(index, state) {                                 
                    $('#city').append($('<option>',{value:state.id, text:state.name}));
                });
            },
            error:function(data){
                console.log(data);
            }
        });
    }
</script>
@endsection