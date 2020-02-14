<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function() {
  Route::get('cities', 'MainController@cities');
  Route::get('districts', 'MainController@districts');
  Route::get('classifications', 'MainController@classifications');
  Route::get('restaurants', 'MainController@restaurants');
  Route::get('restaurants/{id}', 'MainController@restaurantInfo');
  Route::get('search', 'MainController@restaurantSearch');
  Route::get('meals', 'MainController@meals');
  Route::get('meal-details/{id}', 'MainController@mealDetails');
  Route::get('reviews/{id}', 'MainController@reviews');

  Route::get('offers', 'MainController@offers');
  Route::get('payment-methods', 'MainController@paymentMethod');
  Route::get('setting', 'MainController@setting');

  // Route::get('restaurants/{id}/meals/{orderId}', 'MainController@addToCart');

  // Route::post('orders', 'MainController@newOrder');

// Auth Client
  Route::post('login-client', 'AuthClientController@login')->middleware('api');
  Route::post('register-client', 'AuthClientController@register');
// Auth Restaurant
  Route::post('login', 'AuthController@login');
  Route::post('register', 'AuthController@register');

  Route::group(['middleware' => 'jwt.verify'], function() {
// Auth Client
    // Route::group(['middleware' => 'auth:apiClient'], function() {
      Route::post('edit-client-profile', 'AuthClientController@editProfile');
      Route::post('logout-client', 'AuthClientController@logout');

      Route::get('notifications', 'NotifyClientController@clientNotification');
      Route::get('notifications/{id}', 'NotifyClientController@clientNotificationDetails');
      Route::get('notifications-count', 'NotifyClientController@clientNotificationCount');

      Route::get('current-orders-cli', 'OrderClientController@currentClientOrder');
      Route::get('previous-orders-cli', 'OrderClientController@previousClientOrder');
      Route::post('new-order', 'OrderClientController@newOrder');
      Route::post('accept-order', 'OrderClientController@acceptOrder');
      Route::post('decline-order', 'OrderClientController@declineOrder');

      Route::post('register-token-client', 'AuthClientController@registerToken');
      Route::post('remove-token-client', 'AuthClientController@removeToken');

      Route::post('reviews/{id}', 'AuthClientController@addReview');
      Route::post('reviews-meal/{id}', 'AuthClientController@addMealReview');
    // });
// Auth Restaurant
    // Route::group(['middleware' => 'auth:apiRest'], function() {
      Route::post('offers/{id}','OfferController@updateOffer');
      Route::post('meals/{id}','MealController@updateMeal');
      Route::resource('meals', 'MealController');
      Route::resource('offers', 'OfferController');
      Route::post('edit-profile', 'AuthController@editProfile');
      Route::post('contact-us', 'MainController@contactUs');
      Route::post('logout', 'AuthController@logout');
      Route::get('installments', 'AuthController@installments');

      Route::get('notifications-rest', 'NotifyRestaurantController@restaurantNotification');
      Route::get('notifications-rest/{id}', 'NotifyRestaurantController@restaurantNotificationDetails');
      Route::get('notifications-rest-count', 'NotifyRestaurantController@restaurantNotificationCount');

      Route::get('current-orders', 'OrderRestaurantController@currentRestaurantOrder');
      Route::get('previous-orders', 'OrderRestaurantController@previousRestaurantOrder');
      Route::get('new-orders', 'OrderRestaurantController@newRestaurantOrder');
      Route::post('confirm-order', 'OrderRestaurantController@confirmOrder');
      Route::post('delivered-order', 'OrderRestaurantController@deliveredOrder');
      Route::post('rejected-order', 'OrderRestaurantController@rejectedOrder');

      Route::post('register-token', 'AuthController@registerToken');
      Route::post('remove-token', 'AuthController@removeToken');

    // });

  });

});
