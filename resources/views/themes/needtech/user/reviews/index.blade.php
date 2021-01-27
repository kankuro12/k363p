@extends('themes.needtech.layout')
@section('meta')
    <meta name="theme-color" content="#494676" />
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('assets\public\css\userdashboard.css')}}">
@endsection
@section('subtitle','User Profile')
@section('subtitle_color','#494676')
@section('content')
@include('themes.needtech.user.snippets.header')
<section class="dashboard-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="dashboard-sidebar d-none d-lg-block sticky-top" style="top:100px !important">
                    @include('themes.needtech.user.snippets.sidebar')

                </div>
            </div>
            <div class="col-lg-9">
                <div class="dashboard-content-wrapper mb-3 p-4">
                    <h4 class="mb-3 color1 font-weight-bold">Your Ratings and Reviews</h4>
                    <div id="message"></div>
                    <div id="content">


                    </div>
                </div>

                <div class="p-2 shadow">
                    <ul>

                        @foreach($to_reviewed as $to_review)
                            <li id="list_item_{{$to_review->id}}">{{$to_review->vendor->name}} <button onclick="showReview({{$to_review->id}},{{$to_review->vendor->id}})" class="btn">Review</button></li>
                        @endforeach
                    </ul>
                    @if($reviews->count()>0)
                    @foreach($reviews as $index=>$rv)
                    <div class="dash-user-reviews">
                        <div class="dash-user-review">
                            <div class="review-title font-weight-bold">{{$rv->vendor->name}}</div>
                            <div class="rating-star-block " style="color:#28A745;font-size:1.3rem;">

                                <div class="rating-show" data-star="{{$rv->avg_rating}}"></div>
                            </div>
                            <div class="review-desc text-muted pl-3">
                                {{$rv->review_description}}
                            </div>
                        </div>
                    </div>
                    <hr/>
                @endforeach
                {{-- {{$reviews->links()}} --}}
                @else
                <p>You have not reviewed any vendor yet.
                @endif
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal" tabindex="-1" role="dialog" id="review-form-mdl">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="message"></div>
          <form action="{{route('n.user.reviews')}}" method="post" id="review-form">
            <input type="hidden" name="booking_id" id="booking_id" required="required">
            <input type="hidden" name="vendor_id" id="vendor_id" required="required">
            @csrf

                <div class="form-group">
                  <label>Rating</label>
                  {{-- <input id="input-id" type="text" class="rating" data-size="lg" > --}}
                  <span>
                      <div class="rating"></div>
                  </span>
                    <input type="text"  value="0" min="0" max="5" id="rating"  name="rating" class="d-inline d-md-none"/>
                </div>




            <div class="form-group">
              <label>Review Description</label>
              <textarea class="form-control" name="review_description" placeholder="Enter review description" rows="4"></textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn1 btn-block">Save</button>
            </div>



          </form>
        </div>

      </div>
    </div>
  </div>
@endsection
@section('scripts')
    <script>
        function changeProfile() {
        $('#pf-pic').click();
    }
    $('#pf-pic').change(function () {
        if ($(this).val() != '') {
            $('.dash-profile-img').addClass('blink_me');
            upload(this);
        }
    });
    function upload(img) {

            var form_data = new FormData();
            form_data.append('file', img.files[0]);
            form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: "{{route('user.change_profile_pic')}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    $("body").removeClass('loading');
                    $('#profile_img').attr('src', '{{asset('uploads/user/profile_img/200x200/')}}/' + data.profile_img);
                    $('.dash-profile-img').removeClass('blink_me');

                    toastr.success(data.message);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
    }

    function showReview(bid,vid){
        $("#review-form-mdl").modal('show');
        $("#review-form #booking_id").val(bid);
        $("#review-form #vendor_id").val(vid);
    }
    var options = {
        max_value: 5,
        step_size: 0.5,
        initial_value: 0
    }

    $(".rating").rate(options);
    $(".rating-show").each(function(){
        star=this.dataset.star;
        $(this).rate({
            max_value: 5,
            step_size: 0.5,
            initial_value: star,
            readonly: true,
        });
    });
    $(".rating").on("change", function(ev, data){
        console.log(data.from, data.to);
        $('#rating').val(data.to).change();
    });
</script>


@endsection

@section('onload')


@endsection
