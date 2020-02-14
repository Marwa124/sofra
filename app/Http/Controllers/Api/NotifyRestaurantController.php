<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class NotifyRestaurantController extends Controller
{

  public function __construct()
  {
      Config::set('jwt.auth', Restaurant::class);
      Config::set('auth.providers', ['users' => [
          'driver' => 'eloquent',
          'model'  => Restaurant::class,
      ]]);
  }

  public function restaurantNotification(Request $request)
  {
    $notifications = $request->user()->notifications()->latest()->get();

    return apiResponse(1, 'success', $notifications);
  }

  public function restaurantNotificationCount(Request $request)
  {
    $notification_count = $request->user()->notifications()->count();
    return apiResponse(1, 'success', $notification_count);
  }

  public function restaurantNotificationDetails(Request $request, $id)
  {
    $notification = $request->user()->notifications()->find($id);
    return apiResponse(1, 'success', $notification);
  }
}
