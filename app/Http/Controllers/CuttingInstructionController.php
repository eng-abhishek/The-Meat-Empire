<?php

namespace App\Http\Controllers;

use App\CuttingInstruction;
use Illuminate\Http\Request;

class CuttingInstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cut=CuttingInstruction::all();
      return view('admin.cutting_instruction.view',['cut'=>$cut]);
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

        $req=new CuttingInstruction;
        $req->name=$request->cuttingIns;
        $req->save();
        \Session::put('success','Data Add Successfully.');
        return redirect('/cutting-instructions-view');
        //CuttingInstruction
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CuttingInstruction  $cuttingInstruction
     * @return \Illuminate\Http\Response
     */
    public function show(CuttingInstruction $cuttingInstruction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CuttingInstruction  $cuttingInstruction
     * @return \Illuminate\Http\Response
     */
    public function edit(CuttingInstruction $cuttingInstruction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CuttingInstruction  $cuttingInstruction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuttingInstruction $cuttingInstruction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CuttingInstruction  $cuttingInstruction
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuttingInstruction $cuttingInstruction)
    {
        //
    }
}
