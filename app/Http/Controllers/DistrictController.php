<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('districts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // ,exists:cities,id
        $rules = ['name' => 'required', 'city_id' => 'required'];
        // $msg = ['name.required' => __('الأسم مطلوب')];
        $this->validate($request, $rules);

        $district = District::create($request->all());
        $row = view('districts.row',compact('district'))->render();
        // $row = view('admin.dis.row',compact('district'))->render();

        return response()->json([
          'status' => 1,
          'district' => $district->load('city'),
          'row' => $row
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $district = District::find($id);
        if(!$district)
        {
          return response()->json([
            'status' => 0,
            'district' => null,
            'row' => null
          ], 200);
        }
        info($request->all());
        info(json_encode($district));
        $update = $district->update($request->all());
        info(json_encode($district));

        $row = view('districts.row', compact('district'))->render();
        return response()->json([
          'status' => 1,
          'district' => $district,
          'row' => $row
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $district = District::findOrFail($id);
      $district->delete();

      return response()->json($district, 200);
    }
}
