
<div class="owl-collection href" data-target="{{route('n.collection',['slug'=>$collection->slug])}}">
    <div class="image-holder">
        <img src="{{asset('uploads/vendor/collections/263x160/'.$collection->image)}}" alt="">
    </div>
    <div class="coll-desc">
        <div class="coll-title">

            {{$collection->name}}
        </div>
        <div class="coll-subtitle">
            {{$collection->description}}
        </div>
    </div>


</div>

