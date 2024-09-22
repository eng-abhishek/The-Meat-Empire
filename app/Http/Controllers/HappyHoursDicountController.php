<?php

namespace App\Http\Controllers;

use App\HappyHoursDicount;
use Illuminate\Http\Request;

class HappyHoursDicountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $offer=HappyHoursDicount::all();  
       return view('admin.happyHoursDiscount.index',['offer'=>$offer]);
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
     * @param  \App\HappyHoursDicount  $happyHoursDicount
     * @return \Illuminate\Http\Response
     */
    public function show(HappyHoursDicount $happyHoursDicount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HappyHoursDicount  $happyHoursDicount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $editAmount=HappyHoursDicount::find($id);   
      return view('admin.happyHoursDiscount.edit',['editAmount'=>$editAmount]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HappyHoursDicount  $happyHoursDicount

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
     $req=HappyHoursDicount::find($request->editId);
     $req->offer=$request->offer;
     $req->from_date=$request->formDate;
     $req->to_date=$request->toDate;
     $req->update();
     \Session::put('success','Data Update Successfully.');
          return redirect('/happy-hours-discount');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HappyHoursDicount  $happyHoursDicount
     * @return \Illuminate\Http\Response
     */
    public function destroy(HappyHoursDicount $happyHoursDicount)
    {
        //
    }

        public function updateHappyHoursDiscountStatus(Request $request){
            $uDocData=HappyHoursDicount::find($request->input('id'));
            $uDocData->status=$request->servStatus;
            $uDocData->update();
    }
}
