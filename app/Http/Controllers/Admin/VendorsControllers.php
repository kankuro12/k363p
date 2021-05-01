<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Vendor;
use App\Model\Vendor\Category;
use App\Model\Vendor\Location;
use App\Model\Vendor\Country;
use App\Model\Vendor\Room;
use App\User;
use File;
use Image;

use App\FileUpload;
use App\Model\Vendor\RoomAmentiy;
use App\Model\Vendor\RoomPhoto;
use App\Model\Vendor\RoomType;
use App\Model\Vendor\BedType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class VendorsControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $vendors = Vendor::orderBy('created_at', 'desc');
        if ($request->filled('name')) {
            $vendors = $vendors->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('category_id')) {
            $vendors = $vendors->where('category_id', $request->input('category_id'));
        }
        if ($request->filled('star')) {
            $vendors = $vendors->where('star', $request->input('star'));
        }
        if ($request->filled('verified')) {
            $vendors = $vendors->where('verified', $request->input('verified'));
        }
        if ($request->filled('featured')) {
            $vendors = $vendors->where('featured', $request->input('featured'));
        }
        if ($request->filled('country_id')) {
            $vendors = $vendors->whereHas('location', function ($query) {
                $query->whereHas('city', function ($query) {
                    $query->whereHas('state', function ($query) {
                        $query->whereHas('country', function ($query) {
                            $query->where('id', request()->country_id);
                        });
                    });
                });
            });
        }
        if ($request->filled('state_id')) {
            $vendors = $vendors->whereHas('location', function ($query) {
                $query->whereHas('city', function ($query) {
                    $query->whereHas('state', function ($query) {
                        $query->where('id', request()->state_id);
                    });
                });
            });
        }
        if ($request->filled('state_id')) {
            $vendors = $vendors->whereHas('location', function ($query) {
                $query->whereHas('city', function ($query) {
                    $query->where('id', request()->city_id);
                });
            });
        }

        $vendors = $vendors->paginate(10)->setPath('');
        $pagination = $vendors->appends(array(
            'title' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'star' => $request->input('star'),
            'verified' => $request->input('verified'),
            'featured' => $request->input('featured'),
        ));
        $categories = Category::all();
        $countries = Country::all();
        return view('admin.vendors.index', compact('vendors', 'categories', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vcategories = Category::where('status', 'active')->get();
        $countries = Country::all();
        return view('admin.vendors.create', compact('vcategories', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users',
            'category_id' => 'required',
            'phone_number' => 'required',
            'website' => 'nullable|url',
            'average_cost' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'secondary_email' => 'nullable|email',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);
        $user = new User([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 2,
            'active' => $request->status == 'active',

        ]);
        $user->save();
        $vendor = Vendor::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'secondary_email' => $request->secondary_email,
            'category_id' => $request->category_id,
            'user_id' => $user->id,
            'average_cost' => $request->average_cost,
            'description' => $request->description,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'instagram_url' => $request->instagram_url,
            'tripadvisor_url' => $request->tripadvisor_url,
            'website' => $request->website,
            'featured' => $request->featured ?? 0,
        ]);
        $vendor->step = 4;
        $vendor->isverified = 1;
        $vendor->save();
        $location_data = [
            'vendor_id' => $vendor->id,
            'city_id' => $request->city_id,
            'name' => $request->location_name,
            'lat' => $request->lat ?? 0,
            'lng' => $request->lng ?? 0,
        ];
        Location::create($location_data);
        if ($request->hasFile('logo')) {
            $vendor->logo = $request->logo->store('uploads/vendor/logo');
        }
        if ($request->hasFile('cover_img')) {
            $vendor->cover_img = $request->cover_img->store('uploads/vendor/cover_img');
        }
        $vendor->save();
        session()->flash('msg', 'New Vendor has beed successfully added.');
        return redirect()->route('admin.vendors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $vendor = Vendor::where('slug', $slug)->firstOrFail();
        return view('admin.vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $vendor = Vendor::where('slug', $slug)->firstOrFail();
        $vcategories = Category::where('status', 'active')->get();
        $countries = Country::all();
        return view('admin.vendors.edit', compact('vendor', 'vcategories', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required',
            'phone_number' => 'required',
            // 'location_id' => 'required',
            'website' => 'nullable|url',
            'average_cost' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'secondary_email' => 'nullable|email',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
        }
        if ($request->hasFile('cover_img')) {
        }
        $vendor = Vendor::where('slug', $slug)->firstOrFail();
        if ($request->hasFile('logo')) {
            if (File::exists( $vendor->logo) &&  $vendor->logo != 'logo.png') {
                unlink($vendor->logo);
            }
            $vendor->logo = $request->logo->store('uploads/vendor/logo');
        }
        if ($request->hasFile('cover_img')) {
            if (File::exists( $vendor->cover_img) &&  $vendor->cover_img != 'cover.png') {
                unlink( $vendor->cover_img);
            }
            $vendor->cover_img = $request->cover_img->store('uploads/vendor/cover_img');

        }
        $vendor->name = $request->name;
        $vendor->average_cost = $request->average_cost;
        $vendor->secondary_email = $request->secondary_email;
        $vendor->facebook_url = $request->facebook_url;
        $vendor->twitter_url = $request->twitter_url;
        $vendor->instagram_url = $request->instagram_url;
        $vendor->description = $request->description;

        $vendor->featured = $request->featured;
        $vendor->slug = null;
        $vendor->save();
        $vendor->user->active = $request->status;
        $vendor->user->save();

        $location=Location::where('vendor_id',$vendor->id)->first();
        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->save();
        // $vendor->location_id = $request->location_id;
        session()->flash('msg', 'Vendor Details has beed successfully updated.');
        return redirect()->route('admin.vendors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $vendor = Vendor::where('slug', $slug)->firstOrFail();
        $vendor->delete();
        if (File::exists( $vendor->logo)) {
            unlink( $vendor->logo);
        }
        if (File::exists( $vendor->cover_img)) {
            unlink( $vendor->cover_img);
           
        }
        session()->flash('msg', 'Vendor Details has beed successfully deleted.');
        return redirect()->route('admin.vendors');
    }
    public function change_featured(Request $request)
    {
        $vid = $request->vid;
        $value = $request->value;
        $vendor = Vendor::where('id', $vid)->firstOrFail();
        $vendor->featured = $value;
        if ($value == 'active') {
            $vendor->featured_verified = 1;
        } else {
            $vendor->featured_verified = 0;
        }
        $vendor->save();
        if ($vendor->featured == 'inactive') {
            //$vendor->featured=0;
            $msg = "Vendor is successfully removed from featured.";
        } else if ($vendor->featured == 'active') {
            //$vendor->featured=0;
            $msg = "Vendor is successfully added to featured.";
        } else if ($vendor->featured == 'pending') {
            //$vendor->featured='active';
            $msg = "Vendor is successfully added to pending.";
        }
        return response()->json(['message' => $msg, 'fs' => $vendor->featured]);
    }
    public function change_verified(Request $request)
    {
        $vid = $request->vid;
        $vendor = Vendor::where('id', $vid)->firstOrFail();
        if ($vendor->verified) {
            $vendor->verified = 0;
            $msg = "Vendor is successfully removed from verified list.";
        } else {
            $vendor->verified = 1;
            $msg = "Vendor is successfully verified.";
        }
        $vendor->save();
        return response()->json(['message' => $msg, 'vs' => $vendor->verified]);
    }

    public function changePassword(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user != null) {
            $user->password = bcrypt($user->password);
        }
    }

    public function packageEdit($slug, Request $request)
    {
        $package = Room::where('slug', $slug)->first();
        $id = $package->id;
        if ($request->getMethod() == "POST") {

            $user = Auth::user();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'roomtype_id' => 'required',

            ], [
                'name.required' => "Enter name of the Package",
                'name.string' => "Name should be string",
                'roomtype_id.required' => "Select Package Type",

            ]);

            if ($validator->passes()) {

                $package->name = $request->name;
                $package->roomtype_id = $request->roomtype_id;
                $package->price = $request->price;
                $package->discount = $request->discount;
                $package->status = $request->status;
                $package->description = $request->description;
                $package->no_of_rooms = $request->no_of_rooms;
                $package->coupon_enabled = $request->coupon_enabled;
                $package->exta_bed = $request->exta_bed;
                $package->price_of_extra_bed = $request->price_of_extra_bed;
                $package->save();

                if ($request->input('amenity_id') && count($request->input('amenity_id')) > 0) {
                    foreach ($request->input('amenity_id') as $i => $amenity) {
                        $data = RoomAmentiy::where('room_id', $id)->where('id', $request->input('amenity_id')[$i])->firstOrFail();
                        $data->amenity = $request->input('amenity')[$i];
                        $data->room_id = $package->id;
                        $data->save();
                    }
                }



                if ($request->input('new_amenity') && count($request->input('new_amenity')) > 0) {
                    foreach ($request->input('new_amenity') as $i => $amenity) {
                        $data = new RoomAmentiy();
                        $data->amenity = $request->input('new_amenity')[$i];
                        $data->room_id = $package->id;
                        $data->save();
                    }
                }

                if ($files = $request->file('photos')) {
                    foreach ($files as $file) {
                        $room_photo = new RoomPhoto();
                        $name=$file->store('uploads/vendor/roomphotos');
                        $room_photo->image = $name;
                        $room_photo->room_id = $package->id;
                        $room_photo->save();

                        // $thumbnailpath = public_path() . '/uploads/vendor/roomphotos/' . $name;
                        // $thumbnailpath1 = public_path() . '/uploads/vendor/roomphotos/263x160/' . $name;
                        // $img1 = Image::make($thumbnailpath)->resize(263, 160, function ($constraint) {
                        //     $constraint->aspectRatio();
                        // });
                        // $img1->save($thumbnailpath1);
                    }
                }


                session()->flash('msg', 'Package has been updated successfully.');
                return redirect()->back();
            }
        } else {
            $room_types=RoomType::where('status','active')->get();
            $bed_types=BedType::where('status','active')->get();
            return view('admin.vendors.room.edit',['room'=>$package,'room_types'=>$room_types,'bed_types'=>$bed_types]);
        }
    }
}
