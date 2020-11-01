<?php

namespace App\Http\Controllers\API\Vendor\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Model\Vendor\Vendor;
use App\Notifications\Vendor\SignupActivate;
use Carbon\Carbon;
class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'category_id'=>'required',
            'phone_number'=>'required',
            'address'=>'required'
        ]);
        $user = new User([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id'=>2,
            'activation_token' => str_random(60),
        ]);
        $user->save();
        $vendor=Vendor::create([
            'name'=>$request->name,
            'phone_number'=>$request->phone_number,
            'category_id'=>$request->category_id,
            'address'=>$request->address,
            'user_id'=>$user->id,
        ]);
        $user->notify(new SignupActivate($user));

        return response()->json([
            'message' => 'Successfully created user!'
       ], 201);
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'type'=>$user->role_id,
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }
    public function logout(){

    }
    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return $user;
    }
}
