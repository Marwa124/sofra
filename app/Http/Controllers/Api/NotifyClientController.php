<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class NotifyClientController extends Controller
{
  public function __construct(Request $request)
  {
      Config::set('jwt.auth', Client::class);
      Config::set('auth.providers', ['users' => [
          'driver' => 'eloquent',
          'model'  => Client::class,
      ]]);
  }

  public function clientNotification(Request $request)
  {
    $notifications = $request->user()->notifications()->latest()->pluck('title', 'id')->toArray();

    return apiResponse(1, 'success', $notifications);
  }

  public function clientNotificationCount(Request $request)
  {
    $notification_count = $request->user()->notifications()->count();
    return apiResponse(1, 'success', $notification_count);
  }

  public function clientNotificationDetails(Request $request, $id)
  {
    $notification = $request->user()->notifications()->find($id);
    return apiResponse(1, 'success', $notification);
  }

}
