<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Client;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Restaurant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function lang($locale)
    // {
    //     App::setLocale($locale);
    //     session()->put('locale', $locale);
    //     return redirect()->back();
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      return view('home');
    }

    public function restaurants()
    {
      return view('restaurants.index');
    }

    public function destroyRestaurant($id)
    {
      $restaurant = Restaurant::findOrFail($id);
      $classes = $restaurant->classifications()->pluck('classifications.id')->toArray();
      // return response()->json($classes);
      $restaurant->classifications()->detach($classes);
      $restaurant->delete();
      return response()->json($restaurant);
    }

    public function restaurantClassifications()
    {
      return view('restaurants.classification');
    }

    public function destroyClassifications($id)
    {
      $category = Classification::findOrFail($id);
      $rest = $category->restaurants()->pluck('restaurants.id')->toArray();
      $category->restaurants()->detach($rest);
      $category->delete();

      return response()->json($category);
    }

    public function orders()
    {
      $orders = Order::with('restaurant')->latest()->paginate(15);
      return view('orders.index', compact('orders'));
    }

    public function orderShow($id)
    {
      $order = Order::findOrFail($id);
      return view('orders.show', compact('order'));
    }

    public function clients()
    {
      return view('clients.index');
    }

    public function destroyClient($id)
    {
      $client = Client::findOrFail($id);

      if($client->orders()->count())
      {
        return response()->json([
          'status' => 0,
          'message' => __('لا يمكنك حذف هذا المستخدم')
        ]);
      }
      $client->delete();
      return response()->json($client);
    }

    public function offers()
    {
      return view('offers.index');
    }

    public function destroyOffer($id)
    {
      $offer = Offer::findOrFail($id);
      $offer->delete();
      $data = [
        'status' => 1,
        'msg' => 'success',
        'id' => $id
      ];
      return response()->json($data, 200);
    }

    public function profile($id){
      // auth()->user()
      if(Auth::check()){
        return view("profile.edit");
      }
    }

    public function profileUpdate(Request $request)
    {
      $user = $request->user();
      $user->update($request->all());

      if($request['image'])
      {
        if($user->image != '52.png'){
          Storage::disk('public')->delete('/users//' . $user->image);
        }//end of inner if
        Image::make($request->image)
          ->resize(300, null, function($constraint) {
            $constraint->aspectRatio();
          })->save(public_path('uploads/users/' . $request->image->hashName()));

          $user->image = $request->image->hashName();

          $user->save();
      }// end of outer if

      alert()->success('Updated Successfully');

      return redirect(route('home'));
    }

    public function profilePassword()
    {
      return view('profile.password');
    }

    public function profilePasswordUpdate(Request $request)
    {
      $rules = [
        'old-password' => 'required',
        'password' => 'required|confirmed'
      ];

      $msg = [
        'password.required' => 'مطلوب',
        'password.confirmed' => 'غير متوافق'
      ];
      if(Hash::check($request['old-password'], $request->user()->password))
      {
        $this->validate($request, $rules, $msg);
        $request->user()->password = bcrypt($request->password);
        // dd(bcrypt($request->password));

        $request->user()->update($request->all());
        alert()->success('Your password set successfully');

        return redirect(route('home'));
      }else {
        alert()->error('This isn\'t the right password');
        return redirect()->back();
      }
    }
}
