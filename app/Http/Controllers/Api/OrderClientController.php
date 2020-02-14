<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Meal;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class OrderClientController extends Controller
{
  public function __construct(Request $request)
  {
      Config::set('jwt.auth', Client::class);
      Config::set('auth.providers', ['users' => [
          'driver' => 'eloquent',
          'model'  => Client::class,
      ]]);
  }

  public function newOrder(Request $request)
  {
    $validation = validator()->make($request->all(), [
      'restaurant_id' => 'required|exists:restaurants,id',
      'meals.*.meal_id' => 'required|exists:meals,id',
      // 'meal_id.*' => 'required|exists:meals,id',
      'meals.*.quantity' => 'required',
      'accommodation' => 'required',
      'payment_method_id' => 'required|exists:payment_methods,id'
    ]);

    if($validation->fails())
    {
      return apiResponse(0, $validation->errors()->first(), $validation->errors());
    }

    $restaurant = Restaurant::find($request->restaurant_id);

    if($restaurant->is_open == __('closed'))
    {
      return apiResponse(0, 'المطعم غير متاح');
    }

    $order = $request->user()->orders()->create([
      'restaurant_id' => $request->restaurant_id,
      'note' => $request->note,
      'status' => __('pending'),
      'accommodation' => $request->accommodation,
      'payment_method_id' => $request->payment_method_id
    ]);

    $cost = 0;
    $delivery_cost = $restaurant->delivery_fees;
    foreach ($request->meals as $i)
    {
      $item = Meal::find($i['meal_id']);
      $readyItem = [
        $i['meal_id'] => [
          'quantity' => $i['quantity'],
          'price' => $item->price,
          'note' => (isset($i['note'])) ? $i['note'] : ''
        ]
      ];
      $order->meals()->attach($readyItem);
      $cost += ($item->price * $i['quantity']);
    }

    if( $cost >= $restaurant->order_limit )
    {
      $total = $cost + $delivery_cost;
      $commission = settings()->commission * $cost;
      $net = $total - settings()->commission;
      $update = $order->update([
        'price' => $cost,
        'total' => $total,
        'app_fees' => $commission,
        'net' => $net
      ]);

      $notification = $restaurant->notifications()->create([
        'title' => __('لديك طلب جديد'),
        'content' => __('لديك طلب جديد من العميل' . $request->user()->name),
      ]);

      $token = $restaurant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
      // dd($token);
      if( count($token) )
      {
        $title = $notification->title;
        $content = $notification->content;
        $data = [
          'order_id' => $order->id
        ];
        $send = notifyByFirebase($title, $content, $token, $data);
        // dd($send);
        info('firebase resault: ' . $send);
      }
      return apiResponse(1, 'تم الطلب بنجاح', $order->fresh()->load('meals', 'restaurant.district', 'restaurant.classifications', 'client'));
    } else {
      $order->meals()->delete();
      $order->delete();
      return apiResponse(0, 'الطلب لابد أن لا يكون أقل من ' . $restaurant->delivery_limit . ' جنيه');
    }
  }

  public function acceptOrder(Request $request)
  {
    request()->validate([
      'order_id' => 'required|exists:orders,id'
    ]);

    $order = $request->user()->orders()->find($request->order_id);
    if(!$order){
      return apiResponse(0,'لا يوجد اوردر بهذا الرقم');
    }
    if($order->status == ''){
      return apiResponse(0,' تم رفض الطلب من قبل ');
    }
    $order->update([
      'status' => 'accepted'
    ]);
    $restaurant = $order->restaurant()->first();
    $notification = $restaurant->notifications()->create([
      'title' => __(' العميل') . $request->user()->name . __(' أستلم الطلب '),
      'content' => $order->status,
      'action' => 'accepted'
    ]);

    $token = $request->user()->tokens()->where('token', '!=', '')->pluck('token')->toArray();
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

    return apiResponse(1,'تم استلام الطلب', $order);
  }

  public function declineOrder(Request $request)
  {
    request()->validate([
      'order_id' => 'required|exists:orders,id'
    ]);

    $order = $request->user()->orders()->find($request->order_id);
    if(!$order){
      return apiResponse(0,'لا يوجد اوردر بهذا الرقم');
    }
    if($order->status == 'declined'){
      return apiResponse(0,' تم رفض الطلب من قبل ');
    }
    $order->update([
      'status' =>'declined'
    ]);
    $restaurant = $order->restaurant()->first();
    $notification = $restaurant->notifications()->create([
      'title' => __(' العميل') . $request->user()->name . __(' رفض الطلب '),
      'content' => $order->status,
      'action' => 'declined'
    ]);

    $token = $request->user()->tokens()->where('token', '!=', '')->pluck('token')->toArray();
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

    return apiResponse(1,'تم رفض طلبك', $order);
  }

  public function currentClientOrder(Request $request)
  {
    $orders = $request->user()->orders()->where('status', 'pending')
            ->orWhere('status', 'confirmed')->orWhere('status', 'delivered')
            ->latest()->paginate(5);
    return apiResponse(1, 'success', $orders);
  }

  public function previousClientOrder(Request $request)
  {
    $orders = $request->user()->orders()->where('status', 'accepted')
            ->latest()->paginate(5);
    return apiResponse(1, 'success', $orders);
  }
}
