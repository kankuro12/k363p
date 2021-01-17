function loadSearchResult(d,ele,id){
    $('#'+id).val(d);
    $(ele).html('');
    $(ele).hide();

}

$('.search-location').keyup(function(){
    searchstr=$(this).val().toLowerCase();
    target=$(this).data('target');
    id=$(this).attr('id');
    $(target).html('');
    $(target).hide();
    url=$(this).data('url');
    console.log(searchstr,target,url);
    if(searchstr.length>1){
        $('#mobile-search-spinner').removeClass('d-none');
        axios.post(url,{'keyword':searchstr})
        .then(function(response){
            console.log(response);
            $('#mobile-search-spinner').addClass('d-none');
            $(target).show();
            $(target).html('');
            console.log(response.data.data.length);
            if(response.data.data.length>0){

                response.data.data.forEach(element => {
                        $(target).append('<p class="result data" onclick="loadSearchResult(\''+element.name+'\',\''+target+'\',\''+id+'\')">'+element.name+'</p>');
                });
            }else{
                $(target).hide();

            }

        })
        .catch(function(err){
            $('#mobile-search-spinner').addClass('d-none');
            console.log(err);
        });
    }
});

$('#mob-search-input').keyup(function(){
    mob_searchstr=$(this).val().toLowerCase();
    $('#mob-search-result').html("");
    url=$(this).data('url');
    console.log('Search mobile','parameter:'+mob_searchstr,url);
    if(mob_searchstr.length>0){
        $('#clear-mobile-search').removeClass('d-none');
        $('.open-mobile-search').text(mob_searchstr);
    }else{
        $('#clear-mobile-search').addClass('d-none');
        $('.open-mobile-search').text('Search Using City Location and Service');


    }
    if(mob_searchstr.length>1){
        axios.post(url,{'keyword':mob_searchstr})
        .then(function(response){
            console.log(response);
            $('#mob-search-result').html(response.data);
        })
        .catch(function(err){
            console.log(err);
        });
    }
});

$('.open-mobile-search').click(function(){
    $('#mobile-search-holder').addClass('show-mobile-search');
})

$('.close-mobile-search').click(function(){
    $('#mobile-search-holder').removeClass('show-mobile-search');
})
$('#clear-mobile-search').click(function(){
    $('#mob-search-input').val('');
    $('#location1').val('');
    $(this).addClass('d-none');
    $('#mob-search-result').html("");
    $('#mob-search-input').focus();
    $('.open-mobile-search').text('Search Using City Location and Service');
});
