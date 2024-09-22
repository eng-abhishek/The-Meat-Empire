<?php

namespace App\Http\Controllers;

use App\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $discount=Discount::all();
       return view('admin.discount.index',['discount'=>$discount]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $req=Discount::find($id);     
           return view('admin.discount.edit',['discount'=>$req]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request->input();
           $req=Discount::find($request->editId);  
           $req->amount=$request->amount;
           $req->discount=$request->offer;
           $req->pack_of_surprise=$request->surprise;
           $req->update();
         \Session::put('success','Data Update Successfully.');
          return redirect('/discount');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        //
    }

    public function updateDiscountStatus(Request $request){
            $uDocData=Discount::find($request->input('id'));
            $uDocData->status=$request->servStatus;
            $uDocData->update();
    }
}
