<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Installment;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Setting;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use JWTAuth;

class AuthController extends Controller
{

  public function __construct()
    {
        Config::set('jwt.auth', Restaurant::class);
        Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model'  => Restaurant::class,
        ]]);
        // $this->middleware('jwt.auth', ['except' => ['register', 'login', 'activate', 'resend']]);
    }

  public $loginAfterSignUp = true;

  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:restaurants,email',
      'order_limit' => 'required',
      'delivery_fees' => 'required',
      'delivery_time' => 'required',
      'district_id' => 'required',
      'open_time' => 'required',
      'close_time' => 'required',
      'password' => 'required|confirmed',
      'phone' => 'required',
      'days' => 'required',
      'whats_up' => 'required',
      'image' => 'required|image|max:2048',
      'classification' => 'required|array'
    ]);

    $request->merge(['password' => bcrypt($request->password)]);
    $restaurant = Restaurant::create($request->all());
    $restaurant->classifications()->attach($request->classification);

    //Image
    $image = $request->file('image');
    $restaurant->image = 'uploads/restaurants/' . imageStore($image);
    $restaurant->save();

    $token = JWTAuth::fromUser($restaurant);
    $restaurant->{"token"} = $token;

    return apiResponse(0, 'success', [
      'restaurant' => $restaurant
    ]);
  }

  public function editProfile(Request $request)
  {
    $restaurant = $request->user();
// return $restaurant;
    if($request->has('password'))
    {
      $request->merge(['password' => bcrypt($request->password)]);
    }

    //Image Update
    if ($request->hasFile('image')) {
    //   if (file_exists($restaurant->image)) {
    //     unlink($restaurant->image);
    // }
      $img = $request->file('image');

      $restaurant->image = 'uploads/posts/' . imageStore($img);
    }

    $restaurant->update($request->all());

    $newToken = auth()->refresh($restaurant);

    return apiResponse(1, 'succcess', [
      'token' => respondWithToken($newToken),
      'restaurant' => $restaurant
    ]);
  }

  public function login(Request $request)
  {

    $email = $request->email;
    $password = $request->password;


        if ( ! $token = JWTAuth::attempt(['email'=>$email,'password'=>$password])) {
            return response()->json(['error' => 'invalid_credentials'], 400);
        }else{
          $user = Restaurant::where('email', '=', $request->email)->first();
          $token = JWTAuth::fromUser($user);
          $user->{"token"} = $token;
          return response()->json([
              'status'  => 200,
              'data'    => $user,
              'message' => 'تم تسجيل الدخول بنجاح',
          ]);

        }


    return response()->json(compact('token'));
  }

  public function logout()
  {
    auth()->logout();

    return response()->json(['message' => 'Successfully logged out']);
  }

  public function registerToken(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'platform' => 'required|in:android,ios',
            'token' => 'required',
        ]);

        if($validation->fails())
        {
            $data = $validation->errors();
            return apiResponse(0, $data->first(), $data);
        }

        Token::where('token', $request->token)->delete();

        $request->user()->tokens()->create($request->all());
        return apiResponse(1, 'تم التسجيل بنجاح');
    }

    public function removeToken(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'token' => 'required'
        ]);

        if($validation->fails())
        {
            $data = $validation->errors();
            return apiResponse(0, $data->first(), $data);
        }

        Token::where('token', $request->token)->delete();
        return apiResponse(1, 'تم الحذف بنجاح');
    }

    public function installments(Request $request)
    {
      $restaurant_id = Auth::user()->id;
      $price_orders = $request->user()->orders->where('status', 'accepted')->sum('price');
      $setting = Setting::first();
      $commission = $price_orders*($setting->commission/100);
      $payments = $request->user()->installments()->sum('amount');
      $inst = $payments - $commission;
      return apiResponse(1, 'success', [
        'installments' => $inst
      ]);
    }

}
