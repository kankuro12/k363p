@extends('layouts.admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Country</h5>
            </div>
            <div class="card-body">
                @include('layouts.admin.snippets.error')
                <form method="post" action="{{route('admin.post_edit_country',['id'=>$country->id])}}" id="editCountry">
                    @csrf
                    <div class="card-body">                                
                    <div class="form-group">
                        <label for="name">Country Name</label>                        
                        <input type="text" class="form-control" id="name" placeholder="Country Name" name="name" value="{{$country->name}}">
                    </div>
                    <div class="form-group">
                        <label for="phonecode">Country phone code</label>                        
                        <input type="text" class="form-control" id="phonecode" placeholder="Country phonecode" name="phonecode" value="{{$country->phonecode}}">
                    </div> 
                    <div class="form-group">
                        <label for="sortname">Country sortname</label>                        
                        <input type="text" class="form-control" id="sortname" placeholder="Country sortname" name="sortname" value="{{$country->sortname}}">
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
    $("#editCountry").validate({
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

