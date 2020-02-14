<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Meal;
use App\Models\Restaurant;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use JWTAuth;

class AuthClientController extends Controller
{
  public $loginAfterSignUp = true;


  public function __construct(Request $request)
    {
        Config::set('jwt.auth', Client::class);
        Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model'  => Client::class,
        ]]);
    }

  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email',
      'phone' => 'required',
      'district_id' => 'required',
      'password' => 'required|confirmed',
    ]);

    $request->merge(['password' => bcrypt($request->password)]);
    $client = Client::create($request->all());
//Image Create
    if($request->hasFile('profile_image'))
    {
      $image = $request->file('profile_image');
      $client->profile_image = 'uploads/clients/' . imageStore($image);
    }
    $client->save();

    $token = $client->createToken('TutsForWeb')->accessToken;

    return response()->json(['token' => $token], 200);

    // $token = auth()->login($client);

    // return apiResponse(0, 'success', [
    //   'token' => respondWithToken($token),
    //   'client' => $client
    // ]);
  }

  public function login(Request $request)
  {


    $email = $request->email;
    $password = $request->password;


        if ( ! $token = JWTAuth::attempt(['email'=>$email,'password'=>$password])) {
            return response()->json(['error' => 'invalid_credentials'], 400);
        }else{
          $user = Client::where('email', '=', $request->email)->first();
          $token = JWTAuth::fromUser($user);
          $user->{"token"} = $token;
          return response()->json([
                                      'status'  => 200,
                                      'data'    => $user,
                                      'message' => 'تم تسجيل الدخول بنجاح',
                                  ]);

        }


    return response()->json(compact('token'));
  //   $this->validate($request, [
  //     'email'   => 'required|email',
  //     'password' => 'required|min:3'
  //   ]);

  //   $credentials = [
  //     'email' => $request->email,
  //     'password' => $request->password
  //   ];

  // //   if (auth()->attempt($credentials)) {
  // //     $token = auth()->user()->createToken('TutsForWeb')->accessToken;
  // //     return response()->json(['token' => $token], 200);
  // // } else {
  // //     return response()->json(['error' => 'UnAuthorised'], 401);
  // // }

  //   $token = Auth::guard('apiClient')->attempt($credentials, $request->get('remember'));

  //   if (! $token) {
  //     return response()->json(['error' => 'Unauthorized'], 401);
  //   }

  //   if ($token = $this->guard()->attempt($credentials)) {
  //     return $this->respondWithToken($token);
  //   }

  //   return apiResponse(1, 'success', [
  //     $request->all(),
  //     respondWithToken($token)
  //   ]);
  }

  public function editProfile(Request $request)
  {
    $client = $request->user();
// return $client;
    if($request->has('password'))
    {
      $request->merge(['password' => bcrypt($request->password)]);
    }
    if($request->hasFile('profile_image'))
    {
      if (file_exists($client->profile_image)) {
          unlink($client->profile_image);
      }
        $img = $request->file('profile_image');

        $client->profile_image = 'uploads/posts/' . imageStore($img);
    }
    $client->update($request->all());
    $newToken = auth()->refresh($client);

    return apiResponse(1, 'succcess', [
      'token' => respondWithToken($newToken),
      'client' => $client,
    ]);
    return apiResponse(1, 'success', $client);
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

    public function addReview(Request $request, $id)
    {
      $restaurant = $request->user()->orders()->whereHas('restaurant', function($query) use($id){
        $query->where('restaurants.id', $id);
      })->get();
      if( count($restaurant) )
      {
        $restaurantId = Restaurant::find($id)->first();
        //the record in the datebase not the one that i have just created
        $review = $restaurantId->reviewable()->latest()->first();
        // return $review;
        if( $request->all() == null )
        {
          $result = "null";
        }
        request()->validate([
          'rate' => 'numeric|between:1,5',
        ]);
        $restaurantId->reviewable()->create($request->all());
        $result = apiResponse(1, 'success', $review);

        return $result;
      }
    }

    public function addMealReview(Request $request, $id)
    {
      $meal = $request->user()->orders()->whereHas('meals', function($query) use($id){
        $query->where('meals.id', $id);
      })->get();
      if( count($meal) )
      {
        $mealId = Meal::find($id)->first();
        //the record in the datebase not the one that i have just created
        $review = $mealId->reviewable()->latest()->first();
        // return $review;
        if( $request->all() == null )
        {
          $result = "null";
        }
        request()->validate([
          'rate' => 'numeric|between:1,5',
        ]);
        $mealId->reviewable()->create($request->all());
        $result = apiResponse(1, 'success', $review);

        return $result;
      }
    }
}
