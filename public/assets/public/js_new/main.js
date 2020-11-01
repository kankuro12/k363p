window.onscroll = function() {stickyNav()};

var header = document.querySelector(".custom-navbar");

var sticky = header.offsetTop + 100;

function stickyNav() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
$(document).ready(function(){
  $('.featured-hotel-carousel').owlCarousel({
  	items:4,
  	dots:false,
  	nav:true,
  	margin:20
  });
  $('.p-r-n-carousel').owlCarousel({
  	items:2,
  	dots:false,
  	nav:true,
  	margin:20
  });
  $('.collection-carousel').owlCarousel({
    items:4,
    dots:false,
    nav:true,
    margin:20
  });
   $('.p-t-v-carousel').owlCarousel({
  	items:3,
  	dots:false,
  	nav:true,
  	margin:20
  });
   $('.h-gallery-carousel').owlCarousel({
  	items:3,
  	dots:false,
  	nav:true,
  	margin:20
  }); 
});
$(document).ready(function(){
  function update_room_guest(guest,room){
  $("#g-r-input").val(guest+" guest(s), "+room+" room(s)");
}
  //homepage search add guest and room
  $("#guest_trigger").on("click",function(){
    $(".add_g_r_block").toggleClass("hidden");
    $("BODY").prepend("<div class='g-r-backdrop'></div>");
  })
  $("body").on("click",".g-r-backdrop",function(){
    $(".add_g_r_block").addClass("hidden");
    $(".g-r-backdrop").removeClass();
  })
    $(".add_sub_btns .sub_btn").each(function(){
      if($(this).parent().data('val')==1){
        $(this).attr('disabled','disabled')
      }
    })
    $(".add_sub_btns .add_btn").each(function(){
      if($(this).parent().data('val')==10){
        $(this).attr('disabled','disabled')
      }
    })

    $(".add_sub_btns .add_btn").on("click",function(){
      var o_d_val = parseInt($(this).parent().attr('data-val'));
      o_d_val++;
      var d_id = $(this).data('id');
      $(this).parent().attr('data-val',o_d_val)
      $("#"+d_id).text(o_d_val);
      $("#num-"+d_id).val(o_d_val);
      var guest = $("#num-guest-val").val();
      var room = $("#num-room-val").val();
      update_room_guest(guest,room);
      if(o_d_val==10){
        $(this).attr('disabled','disabled')
      }
      if(o_d_val>1){
        $(this).parent().children('.sub_btn').removeAttr('disabled');
      }
    })
    $(".add_sub_btns .sub_btn").on("click",function(){
      var o_d_val = parseInt($(this).parent().attr('data-val'));
      o_d_val--;
      var d_id = $(this).data('id');
      $(this).parent().attr('data-val',o_d_val)
      $("#"+d_id).text(o_d_val);
      $("#num-"+d_id).val(o_d_val);
      var guest = $("#num-guest-val").val()
      var room = $("#num-room-val").val()
      update_room_guest(guest,room);
      if(o_d_val<10){
        $(this).parent().children('.add_btn').removeAttr('disabled')
      }
      if(o_d_val==1){
        $(this).attr('disabled','disabled');
      }
    })
  //tootltip
  $('a[data-toggle="tooltip"]').tooltip();

  //js responsive background image
  $(".img-wrapper").each(function(){
    var background_url = $(this).data("background");
    $(this).css({"background":"url("+background_url+")","background-size":"cover","background-position":"center"})
  }) 

  //animate scroll
  var scrollToElement = function(el, ms){
      var speed = (ms) ? ms : 600;
      $('html,body').animate({
          scrollTop: $(el).offset().top - 100
      }, speed);
  }

  $(".scroll-anim").on("click",function(){
    // specify id of element and optional scroll speed as arguments
    scrollToElement($(this).attr('href'), 600);
  });

});
//change password toggle
$(".change_pass_toggle").click(function(){
  $(".change_pass_wrapper").fadeIn();
});
$(document).ready(function(){
  $(".i-r-progress").each(function(){
    var pct = $(this).data("pct");
    $(this).css("width",pct+'%');  
  });

  //bottom-up-modal
  $("a[data-target='b-u-modal']").each(function(){
    $(this).on('click',function(event){
        event.preventDefault();
        $("BODY").addClass("overflow-hidden");
        var target = $(this).attr("href");
        $(target).addClass("show");
    });
  });

  $(".bottom-up-modal .close-btn").on('click',function(){
      $(this).parent().removeClass("show");
      $("BODY").removeClass("overflow-hidden");
  });
});

$(document).ready(function(){
  //daterangepicker
  $("input[name='ch-in-out'], #search_drp").daterangepicker({
    locale: {
      "format": "YYYY/MM/DD",
      "seperator": "/"
    },
    minDate: moment().startOf('hour'),
    maxDate: moment().startOf('day').add(6, 'month'),
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(24, 'hour'),
  });

  //add room
    $("#num-room").on('change',function(){

      var num_room_old = $(".acb-main-wrapper .acb-wrapper").length;
      var num_room_new = $(this).val();
       
      //checking to add or delete room
      if(num_room_new>num_room_old){
        for(i=0;i<num_room_new-num_room_old;i++){
        
          $(".acb-main-wrapper").append(
              '<div class="acb-wrapper">'+
              '                              <div class="row">'+
              '                                  <div class="col-sm-4">'+
              '                                      <div class="form-group">'+
              '                                          <label>Adults</label>'+
              '                                          <select class="form-control a-select">'+
              '                                              <option value="1" >1</option>'+
              '                                              <option value="2" >2</option>'+
              '                                          </select>'+
              '                                      </div>'+
              '                                  </div>'+
              '                                  <div class="col-sm-4">'+
              '                                      <div class="form-group">'+
              '                                          <label>Child</label>'+
              '                                          <select class="form-control c-select">'+
              '                                              <option value="0" >0</option>'+
              '                                              <option value="1" >1</option>'+
              '                                          </select>'+
              '                                      </div>'+
              '                                  </div>'+
              '                                  <div class="col-sm-4">'+
              '                                      <div class="form-group">'+
              '                                          <label>Bed</label>'+
              '                                          <select class="form-control b-select">'+
              '                                              <option value="1">2 single bed</option>'+
              '                                              <option value="2">1 duoble bed</option>'+
              '                                          </select>'+
              '                                      </div>'+
              '                                  </div>'+
              '                              </div>'+
              '                          </div>'
            );
        }
      }
      if(num_room_new<num_room_old){
        for(j=0;j<num_room_old-num_room_new;j++){
          $(".acb-main-wrapper .acb-wrapper").last().remove();
        }
      }
      var n_adult = 0;
      var n_child = 0;
      function room_guest_val(){
        n_adult = 0;
        n_child = 0; 
        $(".a-select").each(function(){
            n_adult += parseInt($(this).val());  
        });
        $(".c-select").each(function(){
            n_child += parseInt($(this).val());
        });
      }
      room_guest_val();
      update_room_guest(num_room_new,n_adult,n_child);
      $(".a-select,.c-select").on('change',function(){
          room_guest_val();
          update_room_guest(num_room_new,n_adult,n_child);  
      });
    }); 
    var ch_in_out = $("input[name='check-in-out']").val().split('-')
    $("#ch-in").val(ch_in_out[0].trim(" "));
    $("#ch-out").val(ch_in_out[1].trim(" "));
    $("input[name='check-in-out']").on("change",function(){
      ch_in_out = $("input[name='check-in-out']").val().split("-");
        alert(ch_in_out)
      $("#ch-in").val(ch_in_out[0].trim(" "));
      $("#ch-out").val(ch_in_out[1].trim(" "));
    });
});


//function to update no. of rooms and guests
function update_room_guest(n_room,n_adult,n_child){
  
  var rooms = "room";
  var guests = "guest";

  if(n_room>1){
    rooms = "rooms";
  }
  if((n_adult+n_child)>1){
    guests = "guests";
  }
  $("#r-g-num #g-num").text(n_adult+n_child+" "+guests);
  $("#r-g-num #r-num").text(n_room+" "+rooms);

}
//checkout page
$(document).ready(function(){
  $(".checkout-wizard-form .btn").click(function(a){
      a.preventDefault();
      var nav = $(this).attr('href');
      var w_step = $(nav).attr('data-step'); 
      $(".c-w-f").css({"z-index":"-1",
                        "display":"none",
                        "position":"absolute"
      });
      $(nav).css({"z-index":"1",
                  "display":"block",
                  "position":"static"
      });
      console.log(w_step);
      if(w_step==1){
        $(".wizard-step").removeClass("active");
        $(".wizard-step:eq(0)").addClass("active");
      }
      if(w_step==2){
        $(".wizard-step").addClass("active");
        $(".wizard-step:eq(2)").removeClass("active");
      }
      if(w_step==3){
        $(".wizard-step").addClass("active");
      }

  });
});


