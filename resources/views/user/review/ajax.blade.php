 @if($reviews->count()>0)
 @foreach($reviews as $index=>$rv)
    <div class="dash-user-reviews">                    
        <div class="dash-user-review">
          <div class="review-title font-weight-bold">{{$rv->review_title}} - ({{$rv->vendor->name}})</div>
          <div class="rating-star-block">
            @for($i=0;$i<$rv->all_rating();$i++)
            <i class="ion-android-star"></i>
            @endfor
          </div>
          <div class="review-desc text-muted">
            {{$rv->review_description}}
          </div>
        </div>                    
    </div>
    <hr/>
@endforeach
{{$reviews->links()}}
@else
<p>You have not reviewed any vendor yet.
@endif