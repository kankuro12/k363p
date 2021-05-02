@php
    if(isset($data[$key])){
        $section[$key]=json_decode($data[$key]);                                   
    }else{
        $section[$key]=[];
    }
@endphp
<div class="">
<span class="btn btn-primary btn-sm" onclick="add_custom_link_{{$key}}()">Add</button>

</div>
    <div id="custom_links_{{$key}}">
        @foreach ($section[$key] as $l)  
        <div id="custom_link_{{$key}}_{{$l->id}}">
            <input class="custom_link_{{$key}}" type="hidden" name="input_{{$key}}[]" id="input_{{$key}}_{{$l->id}}" value="{{$l->id}}">
            <div class="d-flex" >
                <input type="text" style="flex:4;" placeholder="text" name="link_text_{{$key}}_{{$l->id}}" required value="{{$l->text}}">
                <input type="text" style="flex:4;" placeholder="link" name="link_link_{{$key}}_{{$l->id}}" required value="{{$l->link}}">
                <span  style="flex:2" class="btn btn-link" onclick="del_custom_link_{{$key}}({{$l->id}})">
                    delete
                </span>
            </div>

        </div>
        @endforeach
    </div>
<div >

</div>

<script>
    custom_link_{{$key}}_id=0;
    document.querySelectorAll('.custom_link_{{$key}}').forEach(element => {
        if(parseInt( element.value)>custom_link_{{$key}}_id){
            custom_link_{{$key}}_id= parseInt(element.value);
        }
    });
   
    custom_link_{{$key}}_id+=1;
    
    
    function add_custom_link_{{$key}}(){
        id=custom_link_{{$key}}_id;
        html= '<div id="custom_link_{{$key}}_'+id+'"><input class="custom_link_{{$key}}" type="hidden" name="input_{{$key}}[]" id="input_{{$key}}_'+id+'" value="'+id+'" > <div class="d-flex" ><input type="text" style="flex:4;" placeholder="text" name="link_text_{{$key}}_'+id+'"> <input type="text" style="flex:4;" placeholder="link" name="link_link_{{$key}}_'+id+'"><span style="flex:2"  class="btn btn-link" onclick="del_custom_link_{{$key}}('+id+')">delete</span></div> </div>';
        $('#custom_links_{{$key}}').append(html);
        custom_link_{{$key}}_id+=1;
    }
    function del_custom_link_{{$key}}(id){
        $("#custom_link_{{$key}}_"+id).remove();
    }
</script>