<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\CoBrond;

class CobrandsController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $coBrands=CoBrond::orderBy('id','desc')->get();
       return view('admin.cobrands.index',['coBrands'=>$coBrands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
     return view('admin.cobrands.view'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
           "name"=>'required',           
           "img"=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',             
                         ]); 
        $sreq = new CoBrond;
        $sreq->name=$request->name; 
        $imageName = time().'.'.$request->img->extension();  
        $sreq->img=$imageName;
        $request->img->move(public_path('uploads/cobrands'), $imageName);
        $sreq->save();
        \Session::put('success','Data Add Successfully.');
        return redirect('/co-brand');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deail_of_day  $deail_of_day
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $allAppointment = CoBrond::all();
         return view('admin.cobrands.detail',['dealOfDayDetails'=>$allAppointment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deail_of_day  $deail_of_day
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
   
     $DealOfDay=CoBrond::find($id);
     return view('admin.cobrands.edit',['editData'=>$DealOfDay]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deail_of_day  $deail_of_day
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            $request->validate([
           "name"=>'required',
                              ]); 

        $sreq = CoBrond::find($request->editId);
        $sreq->name=$request->name; 
       
         if($request->img){
        $request->validate([
         "img"=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                  ]); 
        $imageName = time().'.'.$request->img->extension();  
        $sreq->img=$imageName;
        $request->img->move(public_path('uploads/cobrands'), $imageName);
         }else{
        $sreq->img=$request->input('OldImg');
         }
        $sreq->update();
        \Session::put('success','Data Update Successfully.');
         return redirect('/co-brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deail_of_day  $deail_of_day
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      CoBrond::find($id)->delete();
     \Session::put('warning','Data Remove Successfully.');
     return redirect('/co-brand');
    }

    /*----- updateDealOfDayStatus ----*/
    public function updateCoBrandStatus(Request $request){
             $uDocData=CoBrond::find($request->input('id'));
            $uDocData->status=$request->CatStatus;
            $uDocData->update();
    }

}
