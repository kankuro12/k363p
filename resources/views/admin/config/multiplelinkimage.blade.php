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
                <img id="img_{{$key}}_{{$l->id}}" src="{{asset($l->image)}}" alt="" style="max-width:150px;">
                <input type="file" style="flex:4;" placeholder="text" name="link_image_{{$key}}_{{$l->id}}" 
                onchange="imageChange_{{$key}}(this,{{$l->id}},'{{asset($l->image)}}')">
                <input type="text" style="flex:4;" placeholder="link" name="link_link_{{$key}}_{{$l->id}}" required value="{{$l->link}}">
                <input type="hidden"  placeholder="link" name="link_text_{{$key}}_{{$l->id}}" required value="{{$l->image}}">
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
        html= '<div id="custom_link_{{$key}}_'+id+'"><input class="custom_link_{{$key}}" type="hidden" name="input_{{$key}}[]" id="input_{{$key}}_'+id+'" value="'+id+'" > <div class="d-flex" ><img id="img_{{$key}}_'+id+'" src="" alt="" style="max-width:150px;"><input type="file" style="flex:4;" placeholder="text" name="link_image_{{$key}}_'+id+'" required onchange="imageChange_{{$key}}(this,'+id+',null)"><input type="text" style="flex:4;" placeholder="link" name="link_link_{{$key}}_'+id+'"><span style="flex:2"  class="btn btn-link" onclick="del_custom_link_{{$key}}('+id+')">delete</span></div> </div>';
        $('#custom_links_{{$key}}').append(html);
        custom_link_{{$key}}_id+=1;
    }
    function del_custom_link_{{$key}}(id){
        $("#custom_link_{{$key}}_"+id).remove();
    }

    function imageChange_{{$key}}(input,id,def){
   
    
        if (input.files && input.files[0]) 
        {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_{{$key}}_'+id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
        else
        {
        $('#img').attr('src', def);
        }
    }
</script>