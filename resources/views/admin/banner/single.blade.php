<div class="card shadow mt-3 p-2">
    <div class="row">

        <div class="col-md-3">
            <strong>Caption : </strong>{{$banner->caption}}
        </div>
        <div class="col-md-3">
            <strong>Button : </strong>{{$banner->show_button==1?"Show":"Hide"}}
        </div>
        <div class="col-md-3">
            <strong>Button Text : </strong>{{$banner->button_text}}
        </div>
        <div class="col-md-12">
            <strong>Link Url : </strong><a href="{{$banner->link}}">{{$banner->link}}</a>
        </div>
        <div class="col-md-8">
            <div>
                Desktop Image
            </div>
            <img src="{{asset($banner->image)}}" alt="" class="w-100">
    
        </div>
        <div class="col-md-4">
            <div>
                Mobile Image
            </div>
            <img src="{{asset($banner->mobile_image)}}" alt="" class="w-100">
            
        </div>
        <hr>
        <div class="col-md-12 text-right">
            <a href="{{route('admin.banners.edit',['banner'=>$banner->id])}}" class="btn btn-link">Edit</a>
            <a href="{{route('admin.banners.delete',['banner'=>$banner->id])}}" class="btn btn-link">Delete</a>
        </div>
    </div>

</div>