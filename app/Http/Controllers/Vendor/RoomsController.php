<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\RoomType;
use App\Model\Vendor\BedType;
use App\Model\Vendor\Room;
use App\Model\Vendor\RoomAmentiy;
use App\Model\Vendor\RoomPolicy;
use App\Model\Vendor\RoomPhoto;
use App\Model\Vendor\Bed;
use App\Model\Vendor\ChildRoom;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use File;
use App\FileUpload;
use Auth;
use Image;
class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $rooms=Auth::user()->vendor->rooms;
      if($request->ajax()){
        return view('vendor.rooms.ajax.index',compact('rooms'));
      }
      return view('vendor.rooms.index');        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $room_types=RoomType::where('status','active')->get();
        $bed_types=BedType::where('status','active')->get();
        return view('vendor.rooms.create',compact('room_types','bed_types')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user=Auth::user();
      $this->validate($request,[
        'name' => 'required|string',
 
        'price'=>'required',
        'discount'=>'sometimes|nullable|numeric',          
        'amenity.*' => 'required',
        'photos.*'=>'required',
        'roomtype_id' => 'required',  
        'description'=>'required',       
      ],[
        'name.required'=>"Enter name of the Package",
        'name.string'=>"Name should be string",
        'roomtype_id.required'=>"Select Package Type",
        'smooking_policy.required'=>"Select Smooking Policy",
        'room_size.required'=>"Enter Package Size"
      ]);
      $room=new Room();
      $room->name=$request->name;
      $room->roomtype_id=$request->roomtype_id;
      $room->price=$request->price;
      $room->discount=$request->discount;
      $room->status=$request->status;
      $room->description=$request->description;
      $room->no_of_rooms=0;
      $room->vacant_rooms=0;
      $room->vendor_id=$user->vendor->id;
      $room->coupon_enabled=$request->coupon_enabled;
      $room->exta_bed=$request->exta_bed;
      $room->price_of_extra_bed=$request->price_of_extra_bed;
      $room->save();


      foreach($request->input('amenity') as $i => $amenity)
      {
          $data = new RoomAmentiy();
          $data->amenity = $request->input('amenity')[$i];
          $data->room_id=$room->id;
          $data->save();
      }
      if($files=$request->file('photos')){
              foreach($files as $file){
                  $room_photo=new RoomPhoto();                      
                  $name=$file->getClientOriginalName();
                  $file->move('uploads/vendor/roomphotos/',$name);
                  $room_photo->image=$name;
                  $room_photo->room_id=$room->id;
                  $room_photo->save();

                  $thumbnailpath = public_path().'/uploads/vendor/roomphotos/'.$name;
                  $thumbnailpath1 = public_path().'/uploads/vendor/roomphotos/263x160/'.$name;
                  $img1 = Image::make($thumbnailpath)->resize(263, null, function($constraint) {
                              $constraint->aspectRatio();
                          });
                  $img1->save($thumbnailpath1);
          }
      }
      // foreach($request->input('bed_number') as $i => $bed_number)
      // {
      //     $bed = new Bed();
      //     $bed->bed_number = $request->input('bed_number')[$i];              
      //     $bed->bed_type_id=$request->input('bed_type_id')[$i];
      //     $bed->adult=$request->input('adult')[$i];
      //     $bed->child=$request->input('child')[$i];
      //     $bed->room_id=$room->id;
      //     $bed->save();
      // }
      // foreach($request->input('room_number') as $i => $room_number)
      // {
      //     $croom = new ChildRoom();
      //     $croom->room_number = $request->input('room_number')[$i];              
      //     $croom->room_id=$room->id;
      //     $croom->status='active';
      //     $croom->save();
      // }
      return redirect()->route('vendor.get_rooms')->with('msg','Package has been added successfully!!!.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room_types=RoomType::where('status','active')->get();
        $bed_types=BedType::where('status','active')->get();
        $user=Auth::user();
        $room=Room::where('vendor_id',$user->vendor->id)->where('id',$id)->firstOrFail(); 
        return view('vendor.rooms.edit',compact('room_types','bed_types','room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $user=Auth::user();
      $validator=Validator::make($request->all(),[
          'name' => 'required|string',
          'roomtype_id' => 'required',            
         
      ],[
        'name.required'=>"Enter name of the Package",
        'name.string'=>"Name should be string",
        'roomtype_id.required'=>"Select Package Type",
       
      ]);
      
      if ($validator->passes()) { 
          $room=Room::where('vendor_id',$user->vendor->id)->where('id',$id)->firstOrFail(); 
          $room->name=$request->name;
          $room->roomtype_id=$request->roomtype_id;
          $room->price=$request->price;
          $room->discount=$request->discount;
          $room->status=$request->status;
          $room->description=$request->description;
          $room->no_of_rooms=$request->no_of_rooms;
          $room->vendor_id=$user->vendor->id;
          $room->coupon_enabled=$request->coupon_enabled;
          $room->exta_bed=$request->exta_bed;
          $room->price_of_extra_bed=$request->price_of_extra_bed;
          $room->save();

          if($request->input('amenity_id') && count($request->input('amenity_id'))>0){
            foreach($request->input('amenity_id') as $i => $amenity)
            {
                $data = RoomAmentiy::where('room_id',$id)->where('id',$request->input('amenity_id')[$i])->firstOrFail();
                $data->amenity = $request->input('amenity')[$i];
                $data->room_id=$room->id;
                $data->save();
            }
          }



          if($request->input('new_amenity') && count($request->input('new_amenity'))>0){
            foreach($request->input('new_amenity') as $i => $amenity)
            {
                $data = new RoomAmentiy();
                $data->amenity = $request->input('new_amenity')[$i];
                $data->room_id=$room->id;
                $data->save();
            }
          }

          if($files=$request->file('photos')){
                  foreach($files as $file){
                      $room_photo=new RoomPhoto();                      
                      $name=$file->getClientOriginalName();
                      $file->move('uploads/vendor/roomphotos/',$name);
                      $room_photo->image=$name;
                      $room_photo->room_id=$room->id;
                      $room_photo->save();

                      $thumbnailpath = public_path().'/uploads/vendor/roomphotos/'.$name;
                      $thumbnailpath1 = public_path().'/uploads/vendor/roomphotos/263x160/'.$name;
                      $img1 = Image::make($thumbnailpath)->resize(263, 160, function($constraint) {
                                  $constraint->aspectRatio();
                              });
                      $img1->save($thumbnailpath1);
              }
          }

          if($request->input('new_bed_number') && count($request->input('new_bed_number'))>0){

            foreach($request->input('new_bed_number') as $i => $bed_number)
            {
                $bed = new Bed();
                $bed->bed_number = $request->input('new_bed_number')[$i];
                $bed->bed_type_id=$request->input('new_bed_type_id')[$i];
                $bed->adult=$request->input('new_adult')[$i];
                $bed->child=$request->input('new_child')[$i];
                $bed->room_id=$room->id;
                $bed->save();
            }
          }
          if($request->input('bed_id') && count($request->input('bed_id'))>0){
            foreach($request->input('bed_id') as $i => $amenity)
            {
                $bed = Bed::where('room_id',$id)->where('id',$request->input('bed_id')[$i])->firstOrFail();
                $bed->bed_number = $request->input('bed_number')[$i];
                $bed->bed_type_id=$request->input('bed_type_id')[$i];
                $bed->adult=$request->input('adult')[$i];
                $bed->child=$request->input('child')[$i];
                $bed->room_id=$room->id;
                $bed->save();
            }
          }
          if($request->input('croom_id') && count($request->input('croom_id'))>0){
            foreach($request->input('croom_id') as $i => $croom)
            {
                $croom = ChildRoom::where('room_id',$id)->where('id',$request->input('croom_id')[$i])->firstOrFail();
                $croom->room_number = $request->input('room_number')[$i];
                $croom->save();
            }
          }
          session()->flash('msg','Package has been updated successfully.'); 
          return redirect()->route('vendor.get_rooms');
      }        
      return redirect()->back()->withError($validator->errors()); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user=Auth::user();
        $room=$user->vendor->rooms()->where('id',request()->room_id)->firstOrFail();
        $room->delete();
        return response()->json([
          'success'=>1,
          'msg'=>'Package has been deleted successfully!!!.',
        ]);  

    }
    public function amenities($id){        
        return view('vendor.rooms.amenities.index',compact('id'));
    }
    public function post_amenities(Request $request,$id){
        foreach($request->input('amenity') as $i => $amenity)
        {
            $data = new RoomAmentiy();
            $data->amenity = $request->input('amenity')[$i];
            $data->status = $request->input('status')[$i];
            $data->room_id=$id;
            $data->save();
        }
        return response()->json([
          'success'=>1,
          'msg'=>'Service has been updated successfully!!!.',
          'redirect_url'=>route('vendor.get_photos_rooms',['id'=>$id]),
        ]);      
    }
    public function photos($id){
        return view('vendor.rooms.photos.index',compact('id'));
    }
    public function post_photos(Request $request,$id){
        $roomPhoto=new RoomPhoto();
        $roomPhoto->room_id=$id;        
        if($request->hasFile('file')){
            $roomPhoto->image=FileUpload::photo($request,'file','','uploads/vendor/roomphotos',[[200,200],[800,800],[1200,1200]]);
        }
        $roomPhoto->save();
        return response()->json($roomPhoto);
    }
    
    public function edit_amenities($id){
      $user=Auth::user();
      $room=$user->vendor->rooms()->where('id',$id)->firstOrFail();
      $amenities=$room->roomamenities;
      $vendor=$user->vendor;
      if(request()->ajax()){
        return view('vendor.rooms.amenities.ajax.edit',compact('amenities','room'));
      }
      //dd($amenities);
      return view('vendor.rooms.amenities.edit',compact('amenities','room'));
    }
    public function post_edit_amenities(Request $request,$id){
      $a=array();
      foreach($request->input('amenities') as $i => $amenity)
      {
          $data = new RoomAmentiy();
          $data->amenity = $request->input('amenities')[$i];
          $data->status = $request->input('nstatus')[$i];
          $data->room_id=$id;
          $data->save();
          $a[]=$data;
      }
      return response()->json([
           'message' => 'New Service has been updated successfully!!!.',
           'success' => '1',
           'redirect_url'=>route('vendor.get_rooms'),
           'adata'=>$a,
       ], 200);
    }
    public function delete_amenities_rooms($id){
      $user=Auth::user();
      $room=$user->vendor->rooms()->where('id',$id)->firstOrFail();
      $amenity=$room->roomamenities()->where('id',request()->aid)->firstOrFail();
      $amenity->delete();
      return response()->json([
           'message' => 'Service has been deleted successfully!!!.',
           'success' => '1',
           'redirect_url'=>route('vendor.get_rooms'),
       ], 200);           
    }
    public function update_amenities_rooms(Request $request,$id){
      foreach($request->input('amenity') as $i => $amenity)
      {
          $data = RoomAmentiy::where('room_id',$id)->where('id',$request->input('amenity_id')[$i])->firstOrFail();
          $data->amenity = $request->input('amenity')[$i];
          $data->status = $request->input('status')[$i];
          $data->save();
          $a[]=$data;
      } 
      return response()->json([
           'message' => 'Service has been updated successfully!!!.',
           'success' => '1',
           'redirect_url'=>route('vendor.get_edit_photos_rooms',['id'=>$id]),
       ], 200);   
    }    
    
    public function edit_photos($id){
      $user=Auth::user();
      $room=$user->vendor->rooms()->where('id',$id)->firstOrFail();
      $photos=$room->roomphotos;
      if(request()->ajax()){
        return view('vendor.rooms.photos.ajax.edit',compact('photos','room'));
      }
      return view('vendor.rooms.photos.edit',compact('photos','room'));
    }
    public function delete_photos(Request $request,$id){
      $user=Auth::user();
      $room=$user->vendor->rooms()->where('id',$id)->firstOrFail();
      $photo=$room->roomphotos()->where('id',$request->img_id)->firstOrFail();
      if(File::exists('uploads/vendor/roomphotos/'.$photo->image)){
          unlink('uploads/vendor/roomphotos/'.$photo->image);
          unlink('uploads/vendor/roomphotos/263x160/'.$photo->image);
      }
      $photo->delete();
      return response()->json([
           'message' => 'Photos has been updated successfully!!!.',
           'success' => '1',
           'redirect_url'=>route('vendor.get_edit_photos_rooms',['id'=>$id]),
       ], 200);   
    }
    public function delete_bed(Request $request,$id){
      $user=Auth::user();
      $room=$user->vendor->rooms()->where('id',$id)->firstOrFail();
      $bed=$room->beds()->where('id',$request->bed_id)->firstOrFail();
      $bed->delete();
      return response()->json([
           'message' => 'Bed has been deleted successfully!!!.',
           'success' => '1',
       ], 200); 
    }
}
