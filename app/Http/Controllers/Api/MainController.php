<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use App\Models\City;
use App\Models\Classification;
use App\Models\District;
use App\Models\Meal;
use App\Models\Offer;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
  public function cities()
  {
    $cities = City::all();

    return apiResponse(1, 'success', $cities);
  }

  public function districts(Request $request)
  {
    $districts = District::where(function ($query) use ($request) {
      if ($request->has('city_id')) {
        $query->where('city_id', $request->city_id);
      }
    })->get();

    return apiResponse(1, 'success', $districts);
  }

  public function classifications()
  {
    $classifications = Classification::all();

    return apiResponse(1, 'success', $classifications);
  }

  public function contactUs()
  {
    $contact = request()->validate([
      'name'    => 'required',
      'email'   => 'required|email',
      'phone'   => 'required',
      'message' => 'required',
      'type'    => 'required|in:complain,suggestion,inquire',
    ]);

    Mail::to($contact['email'])
      ->cc("marwatest124@gmail.com")
    // ->bcc("marwa120640@gmail.com")
      ->send(new ContactUsMail($contact));

    if ($contact) {
      $response = apiResponse(1, 'Check Your mail', [
        'contact' => $contact,
        'fails'   => Mail::failures(),
        'client'  => $contact['email'],
      ]);
    } else {
      $response = apiResponse(0, $contact->errors()->first(), $contact->errors());
    }

    return $response;
  }

  public function setting()
  {
    $setting = Setting::first();

    return apiResponse(1, 'success', $setting);
  }

  public function offers()
  {
    $offers = Offer::all();

    return apiResponse(1, 'success', $offers);
  }

  public function paymentMethod()
  {
    $payment_methods = PaymentMethod::all();
    return apiResponse(1, 'success', $payment_methods);
  }

  public function restaurants()
  {
    $restaurants = Restaurant::select('*')
      ->select('name', 'order_limit', 'delivery_fees', 'order_limit')
      ->latest()->paginate(5);
    $restaurants = Restaurant::latest()->paginate(5);
    return apiResponse(1, 'success', $restaurants);
  }

  public function reviews($id)
  {
    $restaurant = Restaurant::find($id);
    $review     = $restaurant->reviewable;

    return apiResponse(1, 'success', $review);
  }

  public function restaurantInfo($id)
  {
    $restaurant_info = Restaurant::find($id);

    $district = $restaurant_info->district()->first()->name;
    $city     = $restaurant_info->district->city()->first()->name;

    return apiResponse(1, 'success', [
      'status'        => $restaurant_info->is_open,
      'district'      => $district,
      'city'          => $city,
      'order_limit'   => $restaurant_info->order_limit,
      'delivery_fees' => $restaurant_info->delivery_fees,
      'rate'          => $restaurant_info->rate,
    ]);
  }

  public function restaurantSearch(Request $request)
  {
    $restaurant = Restaurant::where(function ($query) use ($request) {
      if ($request->has('city_id')) {
        $query->whereHas('district', function ($q) use ($request) {
          $q->where('districts.city_id', $request->city_id);
        });
      }
      if ($request->has('keyword')) {
        $query->where('restaurants.name', 'like', '%' . $request->keyword . '%');
      }
    })->paginate(5);
    return apiResponse(1, 'success', $restaurant);
  }

  public function meals()
  {
    $meals = Meal::all();

    return apiResponse(1, 'success', $meals);
  }

  public function mealDetails($id)
  {
    $meal_detail = Meal::find($id);

    return apiResponse(1, 'success', $meal_detail);
  }

  public function addToCart($id, $orderId, Request $request)
  {
    $meal = Meal::find($orderId);

    $restaurant = Restaurant::find($id);
    $meal       = $restaurant->meals()->find($orderId);

    if ($restaurant) {
      if ($restaurant->is_open == __('مغلق')) {
        return apiResponse(0, __('عذرا المطعم غير متاح في الوقت الحالي'));
      }
      if ($meal) {

        $old_cart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new Cart($old_cart);

        if(! $request->has('quantity')){
          $cart->add($meal, 1);
        }else {
          $cart->add($meal, $request->quantity);
        }

        session()->put('cart', $cart);

        return response()->json([
          'success', $cart,
        ]);
      }
    }
  }

}
