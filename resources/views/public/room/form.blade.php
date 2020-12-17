{{-- <div class="acb-main-wrapper">     
    <div class="acb-wrapper">
        @for($b=0;$b<$num_rooms;$b++)       
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Adults</label>
                    <select class="form-control a-select" name="adults[]">
                        @for($i=1;$i<=$room->get_adult_beds()['adult_bed'];$i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Child</label>
                    <select class="form-control c-select" name="childs[]">
                       @if($room->get_adult_beds()['child_bed']>0)
                         @for($i=1;$i<=$room->get_adult_beds()['child_bed'];$i++)
                         <option value="{{$i}}">{{$i}}</option>
                         @endfor
                       @else
                       <option value="0">0</option>
                       @endif
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Bed</label>
                    <select class="form-control b-select" name="beds[]">
                        @for($i=1;$i<=$room->beds->count();$i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        @endfor        
    </div>  
</div> --}}

<input type="hidden" name="price" value="{{$price}}" required="">
<div class="r-g-total">
    <div class="r-g-final-price" id="r-g-final-price">Rs. {{$price}}</div>
</div>
<div class="mt-3">
    <button class="btn btn1 btn-block btn-lg" type="submit">Start Booking
      <i class="ion-chevron-right float-right"></i>      
    </button>
</div>
</form>
