<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class OfferController extends Controller
{

  public function __construct()
  {
      Config::set('jwt.auth', Restaurant::class);
      Config::set('auth.providers', ['users' => [
          'driver' => 'eloquent',
          'model'  => Restaurant::class,
      ]]);
      $this->middleware('jwt.auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offers = $request->user()->offers()->latest()->get();

        if($offers->count())
        {
          return apiResponse(1, 'success', $offers);
        }else {
          return response()->json(['messsage' => 'No data found']);
        }
    }

    public function store(Request $request)
    {
      $validation = validator()->make($request->all(), [
        'title' => 'required',
        'description' => 'required',
        'from' => 'required',
        'to' => 'required',
        'photo' => 'required|image|max:2048'
      ]);

      if($validation->fails())
      {
        return apiResponse(0, $validation->errors()->first(), $validation->errors());
      }

      $offer = $request->user()->offers()->create($request->all());
      //Image
      $image = $request->file('photo');
      $offer->photo = 'uploads/offers/' . imageStore($image);
      $offer->save();

      return apiResponse(1, 'success', $offer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
      $offer = $request->user()->offers()->where('id', $id)->get();
      $result = apiResponse(0, 'No data found');
      if(count($offer))
      {
        $result = apiResponse(1, 'success', $offer);
      }

      return $result;
    }

    public function updateOffer(Request $request, $id)
    {
      $offer = $request->user()->offers()->find($id);
      if($offer->count())
      {
        $offer->update($request->except('photo'));

        //Image Update
        if ($request->hasFile('photo')) {
          if (file_exists($offer->photo)) {
            unlink($offer->photo);
          }

          $image = $request->file('photo');
          $offer->photo = 'uploads/offers/' . imageStore($image);

        }

        $offer->save();
      }
      return $offer;

      return apiResponse(1, 'success', $offer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      $offer = $request->user()->offers()->where('id', $id);
      if(!$offer->exists())
      {
        return apiResponse(0, 'no data found');
      }
        $offer->delete();
        return response()->json('deleted Successfully');
    }
}
