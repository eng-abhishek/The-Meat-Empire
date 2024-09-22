<?php

namespace App\Http\Controllers;

use App\SignupDicount;
use Illuminate\Http\Request;

class SignupDicountController extends Controller
{
   
   public function update(Request $request)
    { 
        $req=SignupDicount::find('1');
        $req->offer=$request->offer;
        $req->from_date=$request->formDate;
        $req->to_date=$request->toDate;
        $req->update();
        \Session::put('success','Data Update Successfully.');
        return redirect('/signup-discount');  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $offer=SignupDicount::all();  
    return view('admin.signupDiscount.index',['offer'=>$offer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $offer=SignupDicount::find('1'); 
      return view('admin.signupDiscount.edit',['offer'=>$offer]);
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
     * @param  \App\SignupDicount  $signupDicount
     * @return \Illuminate\Http\Response
     */
    public function show(SignupDicount $signupDicount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SignupDicount  $signupDicount
     * @return \Illuminate\Http\Response
     */
    public function edit(SignupDicount $signupDicount)
    {
     $editAmount=SignupDicount::find('1');
     return view('admin.signupDiscount.edit',['offer'=>$editAmount]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SignupDicount  $signupDicount
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SignupDicount  $signupDicount
     * @return \Illuminate\Http\Response
     */
    public function destroy(SignupDicount $signupDicount)
    {
        //
    }

        public function updateSignUpDiscountStatus(Request $request){
            $uDocData=SignupDicount::find($request->input('id'));
            $uDocData->status=$request->servStatus;
            $uDocData->update();
    }
}
