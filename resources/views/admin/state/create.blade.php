@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>New State</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.post_create_state')}}" id="addState">
                    @csrf
                    <div class="card-body">                                
                        <div class="form-group">
                            <label for="name">State Name</label>                        
                            <input type="text" class="form-control" id="name" placeholder="State Name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="code">Country</label>                        
                            <select name="country_id" class="form-control">
                            	@foreach($countries as $country)
                            	<option value="{{$country->id}}">{{$country->name}}</option>
                            	@endforeach
                            </select>
                        </div>                                           
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script type="text/javascript">
    $("#addState").validate({
            rules: {
                name: "required",                
                country_code: "required",
                country_currency:"required",
            },
            messages: {
                name: "Please enter country name",
                country_code: "Please enter country code",
                country_currency:"Please enter country currency"
            }
});
</script>
@endsection

