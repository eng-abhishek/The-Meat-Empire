<?php

namespace App\Http\Controllers;

use App\LaunchingDiscount;
use Illuminate\Http\Request;

class LaunchingDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $offer=LaunchingDiscount::all();
     return view('admin.launchingDiscount.index',['offer'=>$offer]);
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
     * @param  \App\LaunchingDiscount  $launchingDiscount
     * @return \Illuminate\Http\Response
     */
    public function show(LaunchingDiscount $launchingDiscount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LaunchingDiscount  $launchingDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $editAmount=LaunchingDiscount::find($id);   
      return view('admin.launchingDiscount.edit',['editAmount'=>$editAmount]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LaunchingDiscount  $launchingDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
     // return $request->input();
     $req=LaunchingDiscount::find($request->editId);
     $req->offer=$request->offer;
     $req->from_date=$request->formDate;
     $req->to_date=$request->toDate;
     $req->update();
     \Session::put('success','Data Update Successfully.');
          return redirect('/launching-discount');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LaunchingDiscount  $launchingDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaunchingDiscount $launchingDiscount)
    {
        //
    }
     public function updateLaunchingStatus(Request $request){
            $uDocData=LaunchingDiscount::find($request->input('id'));
            $uDocData->status=$request->servStatus;
            $uDocData->update();
    }
}
