<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Available_city;
use DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     // $location=Location::orderBy('id','desc')->get();

      $location=DB::table('locations')
      ->select('locations.id','locations.status','locations.location_name as sector','available_cities.name as cityname')
      ->join('available_cities','locations.cate_id','=','available_cities.id')
      ->orderBy('locations.id','desc')
      ->get();
     return view('admin.location.index',['location'=>$location]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $city=Available_city::all();
    return view('admin.location.view',['city'=>$city]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //   return $request->input();
      $location=new Location;
      $location->cate_id=$request->cityId;
      $location->location_name=$request->sectorname;
      $location->save();
      \Session::put('success','Data Add Successfully.');
      return redirect('/sector'); 
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
       $location=Location::find($id);
        $city=Available_city::all();
       return view('admin.location.edit',['location'=>$location,'city'=>$city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $location=Location::find($request->editId);


      $location->cate_id=$request->cityId;
      $location->location_name=$request->sectorname;
      $location->update();
      \Session::put('success','Data Update Successfully.');
        return redirect('/sector'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Location::where('id',$id)->delete();
      \Session::put('danger','Data Delete Successfully.');
      return redirect('/sector');  
    }

       public function updateSectorStatus(Request $request){
            $uDocData=Location::find($request->input('id'));
            $uDocData->status=$request->CatStatus;
            $uDocData->update();
   }
}
