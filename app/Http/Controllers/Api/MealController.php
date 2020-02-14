<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\Restaurant;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class MealController extends Controller
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

    public function index(Request $request)
    {
      $meals = $request->user()->meals()->latest()->paginate(5);
      // dd($meals);
      if($meals->count())
      {
        return apiResponse(1, 'success', $meals);
      }else {
        return response()->json(['message' => 'No Data Found']);
      }
    }

    public function show(Request $request, $id)
    {
      $meal = $request->user()->meals()->where('id', $id)->get();
      $result = apiResponse(0, 'no data found');
      if($meal->exists())
      {
        $result = apiResponse(1, 'success', $meal);
      }
      return $result;
    }

    public function store(Request $request)
    {
      $validation = validator()->make($request->all(), [
        'name' => 'required',
        'preparation_time' => 'required',
        'price' => 'required|numeric',
        'image' => 'required|image|max:2048',
        'ingredients' => 'required',
        'classification_id' => 'required'
      ]);

      if($validation->fails())
      {
        $result = apiResponse(0, $validation->errors()->first(), $validation->errors());
      }

      $meal = $request->user()->meals()->create($request->all());
       //Image
      $image = $request->file('image');
      $meal->image = 'uploads/meals/' . imageStore($image);
      $meal->save();

      $result = apiResponse(1, 'success', $meal);
      return $result;
    }

    public function updateMeal(Request $request, $id)
    {
      $meal = $request->user()->meals()->find($id);
      if($meal->exists())
      {
        $meal->update($request->except('image'));
      }

       //Image Update
      // if ($request->hasFile('image')) {
      //   $img = $request->file('image');

      //   $meal->image = 'uploads/meals/' . imageStore($img);
      // }

      if ($request->hasFile('image')) {
        if (file_exists($meal->image)) {
            unlink($meal->image);
        }
        $path = public_path();
        $destinationPath = $path . '/uploads/meals/'; // upload path
        $photo = $request->file('image');
        $extension = $photo->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
        $photo->move($destinationPath, $name); // uploading file to given path
        $meal->image = 'uploads/meals/' . $name;
    }
    $meal->save();
      return apiResponse(1, 'success', $meal);
    }

    public function destroy(Request $request, $id)
    {
        $meal = $request->user()->meals()->where('id', $id);
        $meal->delete();
        return response()->json(['message' => 'Deleted Successfully']);
    }

}
