<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('payments.index');
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
      $validation = validator()->make($request->all(),[
        'method' => 'required|unique:payment_methods'
      ]);
      if($validation->fails()){
        return response()->json([
          'status' => 0,
          'msg' => 'error',
        ]);
      }

      $method = PaymentMethod::create($request->all());
      $row = view('payments.row', compact('method'))->render();
      return response()->json([
        'status' => 1,
        'msg' => 'success',
        'data' => $method,
        'row' => $row
      ]);
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
        $pay = PaymentMethod::findOrFail($id);
        $method = $pay->update($request->all());

        $row = view('payments.row', compact('method'))->render();

        return response()->json([
          'status' => 1,
          'msg' => 'success',
          'method' => $method,
          'row' => $row
        ]);
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $method->delete();
        return response()->json([
          'status' => 1,
          'msg' => 'success',
          'id' => $method->id
        ]);
    }
}
