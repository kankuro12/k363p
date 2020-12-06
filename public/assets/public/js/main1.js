const districs=[
    "achham",
    "arghakhanchi",
    "baglung",
    "baitadi",
    "bajhang",
    "bajura",
    "banke",
    "bara",
    "bardiya",
    "bhaktapur",
    "bhojpur",
    "chitwan",
    "dadeldhura",
    "dailekh",
    "dang deukhuri",
    "darchula",
    "dhading",
    "dhankuta",
    "dhanusa",
    "dholkha",
    "dolpa",
    "doti",
    "gorkha",
    "gulmi",
    "humla",
    "ilam",
    "jajarkot",
    "jhapa",
    "jumla",
    "kailali",
    "kalikot",
    "kanchanpur",
    "kapilvastu",
    "kaski",
    "kathmandu",
    "kavrepalanchok",
    "khotang",
    "lalitpur",
    "lamjung",
    "mahottari",
    "makwanpur",
    "manang",
    "morang",
    "mugu",
    "mustang",
    "myagdi",
    "nawalparasi",
    "nuwakot",
    "okhaldhunga",
    "palpa",
    "panchthar",
    "parbat",
    "parsa",
    "pyuthan",
    "ramechhap",
    "rasuwa",
    "rautahat",
    "rolpa",
    "rukum",
    "rupandehi",
    "salyan",
    "sankhuwasabha",
    "saptari",
    "sarlahi",
    "sindhuli",
    "sindhupalchok",
    "siraha",
    "solukhumbu",
    "sunsari",
    "surkhet",
    "syangja",
    "tanahu",
    "taplejung",
    "terhathum",
    "udayapur"
];

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
function loadresult(d){
    $('#location').val(d);
    $('#target').html('');
    $('#target').hide();
    targets=0;
}

function loadresult1(d){
    $('#location1').val(d);
    $('#target1').html('');
    $('#target1').hide();
    targets=0;
}

function loadresult2(d){
    $('#location3').val(d);
    $('#mobile-search-target').html('');
    $('#mobile-search-target').hide();
    targets=0;
}
$('.href').click(function(){
    target=$(this).data('target');
    window.location.href=target;
})

// $('#location').focusout(function(){
//     $('#target').hide();
// });

$('#location').focus(function(){
    if(targets>0){
        $('#target').show();
    }
});

$('#location').keyup(function(){
    targets=0;
    data=$(this).val().toLowerCase();
    $('#target').html('');
    $('#target').hide();
    if(data.length>1){
        console.log('start search');

        districs.forEach(element => {
            // console.log(element,data,element.includes(data));
            if(element.toLowerCase().includes(data)){
                $('#target').show();
                $('#target').append('<p class="result data" onclick="loadresult(\''+element+'\')">'+element+'</p>');
                targets+=1;
            }
        });
    }else{
        console.log('stop search');
    }
});

$('#location1').keyup(function(){
    targets=0;
    data=$(this).val().toLowerCase();
    $('#target1').html('');
    $('#target1').hide();
    if(data.length>1){
        console.log('start search');

        districs.forEach(element => {
            // console.log(element,data,element.includes(data));
            if(element.toLowerCase().includes(data)){
                $('#target1').show();
                $('#target1').append('<p class="result data1" onclick="loadresult1(\''+element+'\')">'+element+'</p>');
                targets+=1;
            }
        });
    }else{
        console.log('stop search');

    }
});

$('#location3').keyup(function(){
    targets=0;
    data=$(this).val().toLowerCase();
    $('#mobile-search-target').html('');
    $('#mobile-search-target').hide();
    if(data.length>1){
        console.log('start search');

        districs.forEach(element => {
            // console.log(element,data,element.includes(data));
            if(element.toLowerCase().includes(data)){
                $('#mobile-search-target').show();
                $('#mobile-search-target').append('<p class="result data1" onclick="loadresult2(\''+element+'\')">'+element+'</p>');
                targets+=1;
            }
        });
    }else{
        console.log('stop search');

    }
});


$(".data").click(function(){
    console.log(this);
    var r=$(this).text();
    alert(r);
    $('#location').val(r);
    $('#target').html('');
    $('#target').hide();
});

$(".data1").click(function(){
    console.log(this);
    var r=$(this).text();
    alert(r);
    $('#location1').val(r);
    $('#target1').html('');
    $('#target1').hide();
});

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
        items:1,
        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        autoHeight:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true,
                loop:true,
                margin:2,

            },
            576:{
                items:2,
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
    
    //single vendor header image
    $('#owl-vendor-header').owlCarousel({
        items:1,
        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        loop:true,
        autoplay:true,
        nav:true
    });
    
    //feature services
    $("#owl-feature-services").owlCarousel({
        items:1,
        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        autoHeight:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true,
                loop:true,
                margin:2,

            },
            576:{
                items:2,
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
    stickyNav();
  });
// feature owl couraousel


window.onscroll = function() {stickyNav()};
window.onresize = function() {stickyNav()};

var header = document.querySelector(".secondary-header");

var sticky = 250;

function stickyNav() {
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