<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class OrderRestaurantController extends Controller
{

  public function __construct()
  {
      Config::set('jwt.auth', Restaurant::class);
      Config::set('auth.providers', ['users' => [
          'driver' => 'eloquent',
          'model'  => Restaurant::class,
      ]]);
  }

  public function newRestaurantOrder(Request $request)
  {
    $orders = $request->user()->orders()->where('status', 'pending')->latest()->paginate(5);
    return apiResponse(1, 'success', $orders);
  }

  public function currentRestaurantOrder(Request $request)
  {
    $orders = $request->user()->orders()->where('status', 'confirmed')->latest()->paginate(5);
    return apiResponse(1, 'success', $orders);
  }

  public function previousRestaurantOrder(Request $request)
  {
    $orders = $request->user()->orders()->where('status', 'delivered')->latest()->paginate(5);
    return apiResponse(1, 'success', $orders);
  }

  public function confirmOrder(Request $request)
  {
    request()->validate([
      'order_id' => 'required|exists:orders,id'
    ]);

    $order = $request->user()->orders()->find($request->order_id);
    if(!$order){
      return apiResponse(0,'لا يوجد اوردر بهذا الرقم');
    }
    if($order->status == 'confirmed'){
      return apiResponse(0,'تم تاكبد الطلب من قبل');
    }
    $order->update([
      'status' => 'confirmed'
    ]);
    $client = $order->client()->first();
    $notification = $client->notifications()->create([
      'title' => __(' تم قبول الطلب ') . $request['status'],
      'content' => '',
      'action' => 'confirmed'
    ]);

    $token = $request->user()->tokens()->where('token', '!=', '')->pluck('token')->toArray();
    // dd($token);
    if( count($token) )
    {
      $title = $notification->title;
      $content = $notification->content;
      $data = [
        'order_id' => $request['order_id']
      ];
      $send = notifyByFirebase($title, $content, $token, $data);
      // dd($send);
      info('firebase resault: ' . $send);
    }

    return apiResponse(1,'تم تاكيد طلبك', $order);
  }

  public function deliveredOrder(Request $request)
  {
    request()->validate([
      'order_id' => 'required|exists:orders,id'
    ]);

    $order = $request->user()->orders()->find($request->order_id);
    if(!$order){
      $result = apiResponse(0,'لا يوجد اوردر بهذا الرقم');
    }
    if($order->status == 'delivered'){
      $result = apiResponse(0,'تم توصيل الطلب بنجاح');
    }
    if($order->status != 'confirmed')
    {
      $result = apiResponse(0, 'يجب عليك قبول الطلب اولا');
    }
    $order->update([
      'status' =>'delivered'
    ]);
    $client = $order->client()->first();
    $notification = $client->notifications()->create([
      'title' => __(' تم توصيل الطلب ') . $request['status'],
      'content' => $order->status,
      'action' => 'delivered'
    ]);

    $token = $request->user()->tokens()->where('token', '!=', '')->pluck('token')->toArray();
    // dd($token);
    if( count($token) )
    {
      $title = $notification->title;
      $content = $notification->content;
      $data = [
        'order_id' => $request['order_id']
      ];
      $send = notifyByFirebase($title, $content, $token, $data);
      // dd($send);
      info('firebase resault: ' . $send);
    }

    $result = apiResponse(1,'تم تسليم طلبك', $order);
    return $result;
  }

  public function rejectedOrder(Request $request)
  {
    request()->validate([
      'order_id' => 'required|exists:orders,id'
    ]);

    $order = $request->user()->orders()->find($request->order_id);
    if(!$order){
      $result = apiResponse(0,'لا يوجد اوردر بهذا الرقم');
    }
    if($order->status == 'rejected'){
      $result = apiResponse(0,'تم رفض الطلب ');
    }
    if($order->status == 'delivered' || $order->status == 'confirmed' || $order->status == 'accepted'){
      $result = apiResponse(0, 'لا يمكنك رفض الطلب لقد تم توصيل الطل بالفعل ');
    }
    $order->update([
      'status' =>'rejected'
    ]);
    $client = $order->client()->first();
    $notification = $client->notifications()->create([
      'title' => __(' تم رفض الطلب ') . $order->status,
      'content' => $order->status,
      'action' => 'rejected'
    ]);

    $token = $request->user()->tokens()->where('token', '!=', '')->pluck('token')->toArray();
    // dd($token);
    if( count($token) )
    {
      $title = $notification->title;
      $content = $notification->content;
      $data = [
        'order_id' => $request['order_id']
      ];
      $send = notifyByFirebase($title, $content, $token, $data);
      // dd($send);
      info('firebase resault: ' . $send);
    }
    $result = apiResponse(1,'تم رفض الطلب', $order);
    return $result;
  }
}
