@extends('layouts.public.index')
@section('content')
@include('user.nav')
<section class="dashboard-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-sidebar sticky-top">
                    @include('user.sidebar')
                </div>
            </div>
            <div class="col-md-9">
                <div class="dashboard-content-wrapper p-4">
                    <h4 class="mb-3 color1 font-weight-bold">Your Ratings</h4>
                    @foreach($to_reviewed as $to_review)
                    <li id="list_item_{{$to_review->id}}">{{$to_review->vendor->name}} <button onclick="showReview({{$to_review->id}},{{$to_review->vendor->id}})" class="btn">Review</button></li>
                    @endforeach
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
        <form action="{{route('user.add_review')}}" method="post" id="review-form">
          <input type="hidden" name="booking_id" id="booking_id" required="required">
          <input type="hidden" name="vendor_id" id="vendor_id" required="required">
          @csrf         
          <div class="d-flex justify-content-around">
              <div class="form-group">
                <label>Cleanliness</label>
                <div class="d-flex star-rating">
                   
                        <input type="radio" id="c5" value="5" name="clean" class="form-control" placeholder="Cleanliness">
                         <label for="c5"></label>
                    
                    
                        <input type="radio" id="c4" value="4" name="clean" class="form-control" placeholder="Cleanliness" >
                        <label for="c4"></label>
                    
                    
                        <input type="radio" id="c3" value="3" name="clean" class="form-control" placeholder="Cleanliness" >
                        <label for="c3"></label>
                    
                    
                        <input type="radio" id="c2" value="2" name="clean" class="form-control" placeholder="Cleanliness" >
                        <label for="c2"></label>
                    
                    
                        <input type="radio" id="c1" value="1" name="clean" class="form-control" placeholder="Cleanliness" checked>
                        <label for="c1"></label>
                
                </div>
              </div>
              <div class="form-group">
                <label>Comfortness</label>
                <div class="d-flex star-rating">
                    
                        <input type="radio" id="co5" value="5" name="comfort" class="form-control" placeholder="Comfortness">
                        <label for="co5"></label>
                    
                    
                        <input type="radio" id="co4" value="4" name="comfort" class="form-control" placeholder="Comfortness">
                        <label for="co4"></label>
                    
                    
                        <input type="radio" id="co3" value="3" name="comfort" class="form-control" placeholder="Comfortness">
                        <label for="co3"></label>
                    
                    
                        <input type="radio" id="co2" value="2" name="comfort" class="form-control" placeholder="Comfortness">
                        <label for="co2"></label>
                    
                    
                        <input type="radio" id="co1" value="1" name="comfort" class="form-control" placeholder="Comfortness" checked>
                        <label for="co1"></label>
                    

                </div>
              </div>
          </div>           
          <div class="d-flex justify-content-around">
              <div class="form-group">
                <label>Food</label>
                <div class="d-flex star-rating">
                    
                        <input type="radio" id="f5" value="5" name="food" class="form-control" placeholder="Food">
                        <label for="f5"></label>
                
                    
                        <input type="radio" id="f4" value="4" name="food" class="form-control" placeholder="Food">
                        <label for="f4"></label>
                
                
                        <input type="radio" id="f3" value="3" name="food" class="form-control" placeholder="Food">
                        <label for="f3"></label>
                    
                    
                        <input type="radio" id="f2" value="2" name="food" class="form-control" placeholder="Food">
                        <label for="f2"></label>
                    
                    
                        <input type="radio" id="f1" value="1" name="food" class="form-control" placeholder="Food" checked>
                        <label for="f1"></label>
                
                </div>
              </div>
              <div class="form-group">
                <label>Facilities</label>
                <div class="d-flex star-rating">
                    
                        <input type="radio" id="fa5" value="5" name="facility" class="form-control" placeholder="Facilities">
                        <label for="fa5"></label>
                   
                        <input type="radio" id="fa4" value="4" name="facility" class="form-control" placeholder="Facilities">
                        <label for="fa4"></label>
                    
                        <input type="radio" id="fa3" value="3" name="facility" class="form-control" placeholder="Facilities">
                        <label for="fa3"></label>
                    
                        <input type="radio" id="fa2" value="2" name="facility" class="form-control" placeholder="Facilities">
                        <label for="fa2"></label>
                    
                        <input type="radio" id="fa1" value="1" name="facility" class="form-control" placeholder="Facilities" checked>
                        <label for="fa1"></label>
                   
                </div>
              </div>
          </div>
          <div class="d-flex justify-content-around">
              <div class="form-group">
                <label>Staff Behaviour</label>
                <div class="d-flex star-rating">
                    
                        <input type="radio" id="stb5" value="5" name="staff_behaviour" class="form-control" placeholder="Staff Behaviour">
                        <label for="stb5"></label>
                   
                        <input type="radio" id="stb4" value="4" name="staff_behaviour" class="form-control" placeholder="Staff Behaviour">
                        <label for="stb4"></label>
                    
                        <input type="radio" id="stb3" value="3" name="staff_behaviour" class="form-control" placeholder="Staff Behaviour">
                        <label for="stb3"></label>
                    
                        <input type="radio" id="stb2" value="2" name="staff_behaviour" class="form-control" placeholder="Staff Behaviour">
                        <label for="stb2"></label>
                    
                        <input type="radio" id="stb1" value="1" name="staff_behaviour" class="form-control" placeholder="Staff Behaviour" checked>
                        <label for="stb1"></label>
                   
                </div>
              </div>
          </div>          
          <div class="form-group">
            <label>Review Title</label>
            <input type="text" class="form-control" placeholder="Enter review title" name="review_title">
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
<script type="text/javascript">
  function showReview(bid,vid){
    $("#review-form-mdl").modal('show');
    $("#review-form #booking_id").val(bid);
    $("#review-form #vendor_id").val(vid);
  }
</script>
@endsection
@section('styles')
<link href="{{asset('assets/public/datatable/datatables.min.css')}}" rel="stylesheet" />
@endsection


