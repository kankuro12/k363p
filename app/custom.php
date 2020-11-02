<?php
function cdn_asset($name){
    $asseturl= env('cdn_url',"https://focused-goldstine-1d5480.netlify.app/");
    return $asseturl.$name;
}