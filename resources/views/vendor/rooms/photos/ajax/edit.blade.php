<div class="d-flex">
    @foreach($photos as $photo)
		<div class="edt-img-wrapper">
			<img src="{{asset('uploads/vendor/gallery/'.$photo->image)}}" class="img-responsive">
			<a href="#" class="del-img btn btn-danger btn-fill" data-img-id="{{$photo->id}}">x</a>
		</div>
    @endforeach
</div>