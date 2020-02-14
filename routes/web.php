<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Order;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
// use Barryvdh\DomPDF\Facade as PDF;
use PDFAnony\TCPDF\Facades\AnonyPDF as PDF;

Route::get('/', function () {
  // App::setLocale('ar');
  // dd(App::getLocale());
    return view('welcome');
});

Auth::routes();

// Route::redirect('/', 'en');

Route::group(
  [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
  ], function(){

Route::group(['prefix' => 'admin'], function(){

  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('restaurants', 'HomeController@restaurants')->name('restaurants.index');
  Route::delete('restaurants/{id}', 'HomeController@destroyRestaurant')->name('restaurants.destroy');

  Route::get('restaurants-classifications', 'HomeController@restaurantClassifications')->name('restaurants.category');
  Route::delete('restaurants-classifications/{id}', 'HomeController@destroyClassifications')->name('category.destroy');

  Route::get('orders', 'HomeController@orders')->name('orders.index');
  Route::get('orders/{id}', 'HomeController@orderShow')->name('orders.show');

  Route::get('orders-pdf/{id}', function($id){
    $order = Order::findOrFail($id);
    // $pdf = PDF::loadHTML('<h1>Test</h1>');
    // $pdf = PDF::loadView('orders.pdf', compact('order'));
    $html = view('orders.pdf', compact('order'))->render();
    $pdfarr = [
      'title'=>'اهلا بكم ',
      'data'=>$html, // render file blade with content html
      'header'=>['show'=>false], // header content
      'footer'=>['show'=>false], // Footer content
      'font'=>'dejavusans', //  dejavusans, aefurat ,aealarabiya ,times
      'font-size'=>12, // font-size
      'text'=>'', //Write
      'rtl'=>true, //true or false
      'filename'=>'sofra.pdf', // filename example - invoice.pdf
      'display'=>'print', // stream , download , print
    ];
    $pdf = PDF::HTML($pdfarr);
    // return $pdf->download('invoice.pdf');
    return $pdf;
  })->name('orders.pdf');

  Route::get('clients', 'HomeController@clients')->name('clients.index');
  Route::delete('clients/{id}', 'HomeController@destroyClient')->name('clients.destroy');

  Route::get('offers', 'HomeController@offers')->name('offers.index');
  Route::delete('offers/{id}', 'HomeController@destroyOffer')->name('offers.destroy');

  Route::get('profile/{id}/edit', 'HomeController@profile')->name('profile');
  Route::put('profile/{id}', 'HomeController@profileUpdate')->name('profile.update');
  Route::get('profile-password/{id}', 'HomeController@profilePassword')->name('profile.password');
  Route::put('profile-password', 'HomeController@profilePasswordUpdate')->name('profile.password.update');
  // Route::get('districts', 'HomeController@districts')->name('districts.index');
  // Route::delete('districts/{id}', 'HomeController@destroyOffer')->name('districts.destroy');
  Route::resource('district', 'DistrictController');
  Route::resource('city', 'CityController');

  Route::resource('payment', 'PaymentController');
  Route::resource('installment', 'InstallmentController');
});
});
