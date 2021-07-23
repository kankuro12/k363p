<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PageConfig;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /*
    image,
    text,
    desc,
    link,
    link_group
    */
    private $c=[
        'logo'=>[
            "name"=>"Logo",
            "type"=>"image",
        ],
        'share_image'=>[
            "name"=>"Share Image",
            "type"=>"image",
        ],
        'share_title'=>[
            "name"=>"Share Title",
            "type"=>"text",
        ],
        'share_description'=>[
            "name"=>"Share Description",
            'type'=>"desc"
        ],
        'user_login_bg'=>[
            "name"=>"User Login Background",
            "type"=>"image",
        ],
        'user_login_smbg'=>[
            "name"=>"User Login Background Mobile ",
            "type"=>"image",
        ],
        'vendor_login_bg'=>[
            "name"=>"Vendor Login Background",
            "type"=>"image",
        ],
        'home_search_title'=>[
            "name"=>"Home Search Title",
            'type'=>"text"
        ],
        'footer_title_text'=>[
            "name"=>"Footer Title Text",
            'type'=>"text"
        ],
        'footer_title_links'=>[
            "name"=>"Footer Title links",
            'type'=>"link_group"
        ],
        'footer_2_links'=>[
            "name"=>"Footer Second Links",
            'type'=>"link_group"
        ],'footer_3_links'=>[
            "name"=>"Footer Third Links",
            'type'=>"link_group"
        ],'footer_text_left'=>[
            "name"=>"Footer Text Left",
            'type'=>"desc"
        ],'footer_text_right'=>[
            "name"=>"Footer Text Right",
            'type'=>"desc"
        ],
        'footer_app_title'=>[
            "name"=>"Footer App Title",
            "type"=>"text"
        ],
        'footer_app_android'=>[
            'name'=>"Footer App Android",
            'type'=>'link_image'
        ],
        'footer_app_ios'=>[
            'name'=>"Footer App IOS",
            'type'=>'link_image'
        ],
        'footer_social'=>[
            'name'=>"Footer Social Icons",
            'type'=>'link_image_group'
        ]


    ];
    public function index(Request $request){
        $configs=PageConfig::all();
        $data=[];
        foreach ($configs as $config) {
            $data[$config->identifire]=$config->value;
            if($config->secondary_value!=null){
                $data[$config->identifire."_secondary"]=$config->secondary_value;
            }
        }
        $cs=$this->c;
        return view('admin.config.index',compact('data','cs'));
    }

    public function store(Request $request){
        // dd($request->all());

        foreach ($this->c as $key => $config) {
            $con=PageConfig::where('identifire',$key)->first();
            if($con==null){
                $con=new PageConfig();
                $con->identifire=$key;
            }
            if(strtolower($config['type'])=="image"){
                if($request->hasFile('input_'.$key)){
                    $con->value=$request->file('input_'.$key)->store("uploads/config");
                }
            }elseif(strtolower($config['type'])=="desc"){
                    $con->value=$request->input('input_'.$key);
            }elseif(strtolower($config['type'])=="text"){
                $con->value=$request->input('input_'.$key);
            }elseif(strtolower($config['type'])=="link"){
                $con->value=$request->input('input_'.$key);
                $con->secondary_value=$request->input('input_secondary_'.$key);
            }elseif(strtolower($config['type'])=="link_group"){
               if($request->has('input_'.$key)){
                   $d=[];
                   foreach ($request->all()['input_'.$key] as $id) {
                       $d[$key."_".$id]=(object)[
                           'id'=>$id,
                           'text'=>$request->input("link_text_".$key.'_'.$id),
                           'link'=>$request->input("link_link_".$key.'_'.$id)
                       ];
                   }
                   $do=(object)($d);
                   $doj=json_encode($do);
                   $con->value=$doj;
               }
            }elseif(strtolower($config['type'])=="link_image"){
                if($request->hasFile('input_'.$key)){
                    $con->value=$request->file('input_'.$key)->store("uploads/config");
                }
                $con->secondary_value=$request->input('input_secondary_'.$key);
            }elseif(strtolower($config['type'])=="link_image_group"){
                if($request->has('input_'.$key)){
                    $d=[];
                    foreach ($request->all()['input_'.$key] as $id) {
                        if($request->hasFile("link_image_".$key.'_'.$id)){

                            $d[$key."_".$id]=(object)[
                                'id'=>$id,
                                'image'=>$request->file("link_image_".$key.'_'.$id)->store("uploads/config"),
                                'link'=>$request->input("link_link_".$key.'_'.$id)
                            ];
                        }else{
                            $d[$key."_".$id]=(object)[
                                'id'=>$id,
                                'image'=>$request->input("link_text_".$key.'_'.$id),
                                'link'=>$request->input("link_link_".$key.'_'.$id)
                            ];
                        }
                    }
                    $do=(object)($d);
                    $doj=json_encode($do);
                    $con->value=$doj;
                }
             }

            $con->save();
        }
        return redirect()->back();

    }
}
