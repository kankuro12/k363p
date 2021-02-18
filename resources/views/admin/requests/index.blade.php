@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Vendor Requests
                </h5>
            </div>
            <div class="card-body">
                <div class="content table-responsive table-full-width">
                    @include('layouts.admin.snippets.msg')
                    <table class="table">
                        
                            <tr>

                                <th>
                                    #ReqID
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Phone
                                </th>
                                <th>
                                    Address
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Owner
                                </th>
                            </tr>
                            @foreach ($req as $item)
                                <tr>
                                    <td>
                                        {{$item->id}}
                                    </td>
                                    <td>
                                        {{$item->name}}
                                    </td>
                                    <td>
                                        {{$item->phone}}
                                    </td>
                                    <td>
                                        {{$item->address}}
                                    </td>
                                    <td>
                                        {{$item->email}}
                                    </td>
                                    <td>
                                        {{$item->owner}}
                                    </td>
                                </tr>
                            @endforeach
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection