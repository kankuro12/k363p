@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Enquiries</h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table class="table table-hover p-0" id="enquiries">
                        <thead>
                        <tr>
                          <th>S.N.</th>
                          <th>Name</th>              
                          <th>Email Address</th>
                          <th>Contact number</th>
                          <th>Subject</th>
                          <th>Message</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($enquiries as $index=>$enquiry)
                        <tr>
                         <td>{{$index+1}}</td>
                         <td>{{$enquiry->name}}</td>
                         <td>{{$enquiry->email}}</td>
                         <td>{{$enquiry->phone}}</td>
                         <td>{{$enquiry->subject}}</td>
                         <td>{{$enquiry->message}}</td>
                        </tr>
                        @endforeach          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
$('#enquiries').DataTable();
</script>
@endsection


