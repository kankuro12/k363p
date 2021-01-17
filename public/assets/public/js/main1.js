
function toogleSearch(ele){
    if(ele.dataset.set==1){
        ele.innerHTML='<i class="fas fa-times"></i>';
        ele.dataset.set=2;
        $('#min-search-bar').collapse('show')
    }else{
        ele.innerHTML='<i class="fas fa-search"></i>';
        ele.dataset.set=1;
        $('#min-search-bar').collapse('hide')
    }
}

var targets=0;

$('.href').click(function(){
    target=$(this).data('target');
    window.location.href=target;
})



$('#select-service').select2({
    placeholder: "Choose A Service",
    allowClear: true
});
$('#select-service1').select2({
    placeholder: "Choose A Service",
    allowClear: true
});
$('#select-service2').select2({
    placeholder: "Choose A Service",
    allowClear: true
});
$(document).ready(function(){
    $(".scroll").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior

          // Prevent default anchor click behavior


          // Store hash
          var hash = "#"+$(this).data('target');

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){

            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        // End if
      });
    console.log($("#owl-feature-vendors"));
    //feature vendors
    $("#owl-feature-vendors").owlCarousel({
        items:2,
        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        autoHeight:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1.5,
                nav:true,
                loop:true,
                margin:5,

            },
            576:{
                items:2.5,
                nav:true,
                loop:false,
                margin:10,

            },
            800:{

                items:3,
                nav:false,
                loop:false,
                margin:10,


            },
            1024:{
                items:3,
                nav:false,
                loop:false,
                margin:10,

            },
            1366:{
                items:4,
                nav:false,
                loop:false,
                margin:10,
            }
        }
    });



    //feature services
    $("#owl-feature-services").owlCarousel({
        items:2,
        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        autoHeight:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1.5,
                nav:true,
                loop:true,
                margin:5,

            },
            576:{
                items:2,
                nav:true,
                loop:false,
                margin:10,

            },
            768:{

                items:2.6,
                nav:false,
                loop:false,
                margin:10,


            },
            1024:{
                items:3.2,
                nav:false,
                loop:false,
                margin:10,

            },
            1366:{
                items:4,
                nav:false,
                loop:false,
                margin:10,
            }
        }
    });

    // services
    $("#owl-services").owlCarousel({
        items:2,
        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        autoHeight:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:2.2,
                nav:true,
                loop:true,
                margin:5,

            },
            576:{
                items:3,
                nav:true,
                loop:false,
                margin:10,

            },
            800:{

                items:3.5,
                nav:false,
                loop:false,
                margin:10,


            },
            1024:{
                items:4,
                nav:false,
                loop:false,
                margin:10,

            },
            1366:{
                items:6,
                nav:false,
                loop:false,
                margin:10,
            }
        }
    });

    //collection
    $("#owl-collections").owlCarousel({
        items:2,
        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        autoHeight:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1.1,
                nav:true,
                loop:false,
                margin:5,

            },
            576:{
                items:2.1,
                nav:true,
                loop:false,
                margin:10,

            },
            800:{

                items:2.8,
                nav:false,
                loop:false,
                margin:10,


            },
            1024:{
                items:3.2,
                nav:false,
                loop:false,
                margin:10,

            },
            1366:{
                items:4,
                nav:false,
                loop:false,
                margin:10,
            }
        }
    });
    stickyNav();
  });
// feature owl couraousel


window.onscroll = function() {stickyNav();mobilemenu_scroll();};
window.onresize = function() {stickyNav();mobilemenu_scroll();};

var header = document.querySelector(".secondary-header");

var sticky = 250;
function stickyNav() {
    console.log('referer',document.referrer);
    if(header!=undefined){

        if(header.dataset.semi==0){
            if(window.innerWidth>1024){

                header.style.display="block";
            }else{
                header.style.display="none";

            }
        }else{
            if (window.pageYOffset > sticky) {

                if(window.innerWidth>1024){

                    header.style.display="block";
                }else{
                    header.style.display="none";

                }
              } else {
                // header.classList.remove("sticky");
                header.style.display="none";

              }
        }
    }

}

