@if(Session::has('msg'))
<div class="alert alert-success">
  <!-- <button type="button" aria-hidden="true" class="close">
    <i class="now-ui-icons ui-1_simple-remove"></i>
  </button> -->
  <span>
  	{{ Session::get('msg') }}
  </span>
</div>
@endif
