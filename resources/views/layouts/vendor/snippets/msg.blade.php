@if(Session::has('msg'))
<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
  <strong>{{ Session::get('msg') }}</strong>
</div>
@endif

