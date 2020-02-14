<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

// use Alert;

class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('installments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('installments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = [
        'restaurant_id' => 'required|exists:restaurants,id',
        'amount' => 'required|numeric|max:999999',
      ];
      $msg = [

      ];
      $this->validate($request, $rules, $msg);

      $install = Installment::create($request->all());

      return redirect(route('installment.index'));
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
      $install = Installment::findOrFail($id);
        return view('installments.edit', compact('install'));
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
      $install = Installment::findOrFail($id);
      $install->update($request->all());
      // alert()->success('Title','Lorem Lorem Lorem');
      // toast('Success Toast','success');

      Alert::success('Success Title', 'Success Message');
      return redirect(route('installment.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $install = Installment::findOrFail($id);
        $install->delete();
        // toast('Success Toast','success');
      Alert::success('Success Title', 'Success Message');
      // alert()->success('Title','Lorem Lorem Lorem');


        return back();
    }
}
