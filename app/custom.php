<?php
function cdn_asset($name){
    $asseturl= env('cdn_url',"https://focused-goldstine-1d5480.netlify.app/");
    return $asseturl.$name;
}

function _view($path){
    return "themes.". env('theme',"needtech").".".$path;
}

function _snippets($path){
    return "themes.". env('theme',"needtech").".snippets.".$path;
}

function custom_config($id){
    return \App\PageConfig::where('identifire',$id)->first();
}

function loadMapApi(){
    return "";
}

function htmlToPlainText($str){
    $str = str_replace('&nbsp;', ' ', $str);
    $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
    $str = html_entity_decode($str);
    $str = htmlspecialchars_decode($str);
    $str = strip_tags($str);

    return $str;
}

