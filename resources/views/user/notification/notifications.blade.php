@extends('layouts.public.index')
@section('content')
@include('user.nav')
<section class="dashboard-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-sidebar sticky-top">
                    @include('user.sidebar')
                </div>
            </div>
            <div class="col-md-9">
                <div class="dashboard-content-wrapper p-4">
                    <h4 class="mb-3 color1 font-weight-bold">Notifications</h4>
                    <table class="table table-bordered" id="notifications">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Notification Title</th>
                            <th>Notification Description</th>
                            <th>Received At</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $i=>$dt)
                          <tr class="{{$dt->read_at?'':'alert alert-warning'}}">
                            <td>{{$i+1}}</td>
                            <td>
                              <a href="{{route('user.get_notification',['id'=>$dt->id])}}">{{$dt->data['title']}}</a>
                            </td>
                            <td>{{$dt->data['detail']?$dt->data['detail']:'N/A'}}</td>
                            <td>{{$dt->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                                                   
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{asset('assets/public/datatable/datatables.min.js')}}"></script>
<script type="text/javascript">
     $('#notifications').DataTable();
</script>
@endsection
@section('styles')
<link href="{{asset('assets/public/datatable/datatables.min.css')}}" rel="stylesheet" />
@endsection