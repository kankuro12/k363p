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

// $('#location').focusout(function(){
//     $('#target').hide();
// });

$('#location').focus(function(){
    if(targets>0){
        $('#target').show();
    }
});

$('#location44').keyup(function(){
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
