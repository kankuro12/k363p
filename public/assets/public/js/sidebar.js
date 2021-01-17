var sidebar={
    state:1,
    toogle:function(){
       this.state=$('#sidebar').data('state');
       if(this.state==1){
            $('#sidebar').addClass('extended');
            $('#sidebar').data('state',0)
       }else{
            $('#sidebar').removeClass('extended');
            $('#sidebar').data('state',1)
       }
    }
}

$('#sidebar').click(function (e) {
    if (e.target !== this)
    return;
    sidebar.toogle();
});

