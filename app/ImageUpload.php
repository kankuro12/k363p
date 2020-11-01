<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
use Image;
class FileUpload extends Model
{
    public static function photo($request,$filename,$default='',$path,$sizes=null){
        $image = $request->file($filename);
        $name = time().'.'.$image->getClientOriginalExtension();
        

        //Resizes Images
        for ($i=0;$i<count($sizes);$i++){

            $img = Image::make($image->getRealPath());

            $a= public_path().'/'.$path.'/'.str_replace(',','x',$sizes[$i][0].'x'.$sizes[$i][1]);
            if(!File::exists($a)) {
                File::makeDirectory($a);
            }
            $img->resize($sizes[$i][0],null,function ($constraint) {
                $constraint->aspectRatio();
                //$constraint->upsize();
            })->save($a.'/'.$name,100);
        }
        $destinationPath = public_path($path);
        $image->move($destinationPath, $name);
        return $name;
    }
}









