<?php

use App\Model\Vendor\Booking;
use App\Model\Vendor\BookingPayment;
use App\Model\Vendor\Category;
use App\Model\Vendor\City;
use App\Model\Vendor\Country;
use App\Model\Vendor\Location;
use App\Model\Vendor\Room;
use App\Model\Vendor\RoomPhoto;
use App\Model\Vendor\RoomType;
use App\Model\Vendor\State;
use App\Model\Vendor\Vendor;
use App\Model\VendorUser\VendorUser;
use App\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use \Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('make:locations', function () {
    $provinces = App\Data::provinces;
    $cities = App\Data::cities;
    $country = new Country();
    $country->name = "Nepal";
    $country->name = "NP";
    $country->name = "977";
    $country->save();

    for ($i = 0; $i < 7; $i++) {
        $state = new State();
        $state->name = $provinces[$i];
        $state->country_id = $country->id;
        $state->save();
        echo $state->name . "  Province Added";
        foreach ($cities[$i] as $key => $city_name) {
            $city = new City();
            $city->name = $city_name;
            $city->state_id = $state->id;
            $city->save();
            echo $state->name . " City Added";
        }
    }
});

Artisan::command('make:categories', function () {
    $cats = App\Data::cats;
    $arr = explode(",", $cats);
    $temparr = [];
    // dd($arr);
    for ($i = 0; $i < count($arr); $i++) {
        $temp = $arr[$i];
        $data = (explode("=>", $temp));
        if (count($data) > 1) {
            $data1 = $data[1];
            $data2 = str_replace('"', '', $data1);
            $data3 = trim($data2);
            array_push($temparr, $data3);
        }
    }

    foreach ($temparr as $key => $value) {
        $categories = new Category();
        $categories->name = $value;
        $categories->description = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus excepturi consequuntur labore facilis incidunt, inventore ipsam dolorem quasi ipsa. Vitae quidem adipisci ut impedit dicta rerum totam! Perspiciatis, veniam repellat?";
        $categories->status = "Active";
        $categories->save();
        echo $value . " Added \n";
    }
});
Artisan::command('make:vendor', function () {
    // $email="cms@gmail.com";
    $lats = App\Data::lats;
    $lans = App\Data::lans;

    $phone = 9800000000;
    $faker = Faker\Factory::create();
    $city_ids = City::pluck('id');
    $cityCount = count($city_ids);

    $cat_ids = Category::pluck('id');
    $catCount = count($cat_ids);

    for ($i = 0; $i < 1000; $i++) {
        $user = new User();
        $user->email = "cms" . $i . "@gmail.com";
        $user->password = bcrypt("admin123");
        $user->role_id = 2;
        $user->active = 1;
        $user->save();

        $vendor = new Vendor();
        $vendor->user_id = $user->id;
        $vendor->category_id = $cat_ids[mt_rand(0, $catCount - 1)];
        $vendor->name = $faker->company;
        // $vendor->address = $faker->address();
        $vendor->description = $faker->text();
        $vendor->phone_number = $phone + $i;
        $vendor->featured = mt_rand(0, 1);
        $vendor->step = 4;
        $vendor->isverified = 1;
        $vendor->save();
        echo $vendor->name . " Added \n";

        $location = new Location();
        $location->name = $faker->address();
        $location->vendor_id = $vendor->id;
        $location->city_id = $city_ids[mt_rand(0, $cityCount - 1)];
        $l = mt_rand(0, (count($lats) - 1));
        echo $l . " indexed \n";

        $location->lat = $lats[$l];
        $location->lng = $lans[$l];
        $location->save();
    }
});

Artisan::command("make:packagetype", function () {
    $occs = App\Data::occupations;
    foreach ($occs as $key => $value) {
        $packageType = new RoomType();
        $packageType->name = $value;
        $packageType->status = "Active";
        $packageType->save();
        echo $value . " Added \n";
    }
});

Artisan::command("make:packages", function () {
    $vendors = Vendor::pluck('id');
    $roomtypes = RoomType::select('id', 'name')->get();
    $roomtypecount = $roomtypes->count();
    $faker = Faker\Factory::create();
    foreach ($vendors as $key => $vendor_id) {
        for ($i = 0; $i < 10; $i++) {
            # code...
            $room = new Room();
            $rt = $roomtypes[mt_rand(0, $roomtypecount - 1)];
            $room->name = $rt->name . " Tranning";
            $room->roomtype_id = $rt->id;
            $room->price = mt_rand(3000, 45000);
            $room->discount = 0;
            $room->status = "Available";
            $room->description = $faker->text();
            $room->no_of_rooms = 0;
            $room->vacant_rooms = 0;
            $room->vendor_id = $vendor_id;
            $room->save();
            echo $room->name . " Added \n";
        }
    }
});

Artisan::command('make:roomphotos', function () {
    $rooms = Room::pluck('id');
    foreach ($rooms as $room_id) {
        $room_photo = new RoomPhoto();
        $room_photo->image = "uploads\vendor\roomphotos\rf.jpg";
        $room_photo->room_id = $room_id;
        $room_photo->save();
    }
});

Artisan::command('make:admin', function () {
    \App\Admin::create([
        'name' => 'Abtest Abtest',
        'email' => 'admin@admin.com',
        'password' => bcrypt('admin@123'),
        'active' => 1,
        'remember_token' => str_random(10),
    ]);
});


Artisan::command('make:user', function () {
    $rooms = Room::select('id','price','vendor_id')->get();
    $rc = count($rooms) - 1;
    $arr = [];
    $faker = Faker\Factory::create();
    $phone = 9800100000;
    for ($i = 0; $i < 5000; $i++) {
        $user = new User();
        $user->email = "user" . $i . "@gmail.com";
        $user->password = bcrypt('password');
        $user->role_id = 1;
        $user->activation_token = mt_rand(100000, 999999);
        if (count($arr) > 1) {
            $ref_id = $arr[mt_rand(0, count($arr) - 1)];
            $user->referal_id = $ref_id;
        }
        $user->save();
        $data = new VendorUser();
        $data->user_id = $user->id;
        $data->fname = $faker->firstName();
        $data->lname = $faker->lastName();
        $data->mobile_number = $phone + $i;
        $data->save();

        array_push($arr, $user->id);

        for ($j = 0; $j < 3; $j++) {
            $room = $rooms[mt_rand(0, $rc)];
            $booking = new Booking();
            $booking->check_in_time = session('date');

            $booking->new_price = $room->price;
            $booking->first_name = $data->fname;
            $booking->last_name = $data->lname;
            $booking->email = $user->email;
            $booking->room_id = $room->id;
            $booking->phone_number = $data->mobile_number;
            $booking->user_id = $data->id;
            $booking->payment_addition_info = $faker->text();
            $booking->type = mt_rand(1, 2);
            $booking->vendor_id = $room->vendor_id;
            $booking->booking_id = time();
            $booking->save();


            if ($booking->type == 2) {
                $bp = new BookingPayment();
                $bp->booking_id = $booking->id;
                $bp->type = 'online';
                $bp->provider = "Khalti";
                $bp->token =Str::random(10);
                $bp->voucher = Str::random(10);
                $bp->overall = '';
                $bp->status = 1;
                $bp->save();
            }
        }
    }
});
