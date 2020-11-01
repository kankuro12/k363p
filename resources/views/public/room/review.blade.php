@if($reviews->count()>0)
@foreach($reviews as $vr)
<div class="user-reviews">
    <div class="user-review">
        <div class="user-img-name mb-2">
            <div class="user-img-wrapper">
                <img src="{{asset('uploads/user/profile_img/200x200/'.$vr->vendor_user->profile_img)}}" class="img-fluid">
            </div>
            <span class="user-name">{{$vr->vendor_user->fname." ".$vr->vendor_user->lname}}</span>
        </div>
        <div class="review-title">
            {{$vr->review_title}}
        </div>
        <div class="review-desc mt-2">
            {{$vr->review_description}}
        </div>
        <div class="user-rat">{{$vr->rating()}}</div>
    </div>
</div>
<hr>
@endforeach
@endif
