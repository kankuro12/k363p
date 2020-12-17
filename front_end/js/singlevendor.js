// $(".services").each(function(){

//     $(this).owlCarousel({
//         items:1,
//         navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
//         autoHeight:true,
//         responsiveClass:true,
//         nav:false,
//         responsive:{
//             0:{
//                 items:1,
//                 nav:true,
//                 loop:true,
//                 margin:2,

//             },
//             576:{
//                 items:2,
//                 nav:false,
//                 loop:false,
//                 margin:10,

//             },
//             800:{
                
//                 items:2,
//                 nav:false,
//                 loop:false,
//                 margin:10,

                
//             },
//             1024:{
//                 items:2,
//                 nav:false,
//                 loop:false,
//                 margin:10,

//             },
//             1366:{
//                 items:3,
//                 nav:false,
//                 loop:false,
//                 margin:10,
//             }
//         }
//     });
// });

$('.image-holder').each(function(){
    $(this).owlCarousel({
        items:1,
        loop:true,
        autoHeight:true,
        responsiveClass:true,
        nav:false,
        margin:2
    });
});