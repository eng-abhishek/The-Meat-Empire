<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Available_city;
use App\MinOrderAmount;

class DeliveryLocationController extends Controller
{

public function index(){
	$city=Available_city::all();
return view('admin.delivery_location.index',['offer'=>$city]);
}  

public function edit($id){
$editAmount =Available_city::find($id);
return view('admin.delivery_location.edit',['editAmount'=>$editAmount]);
}

public function update(Request $request){
    
     $res=Available_city::find($request->editId);
     $res->name=$request->city_name;
     $res->category=$request->cate;

     $res->update();
     \Session::put('success','Data Update Successfully.');
     return redirect('/city'); 
}

public function minOrderAmount(){
$orderamt=MinOrderAmount::all();
return view('admin.min_order_amount.index',['offer'=>$orderamt]);
}

public function minOrderAmountEdit($id){
$editAmount =MinOrderAmount::find($id);
return view('admin.min_order_amount.edit',['editAmount'=>$editAmount]);

}

public function minOrderAmountUpdate(Request $request){
     $res=MinOrderAmount::find($request->editId);
     $res->amount=$request->amount;
     $res->category=$request->cate;
     $res->expressDelAmount=$request->expressDelAmount;
     $res->update();
     \Session::put('success','Data Update Successfully.');
     return redirect('/min-order-amount'); 
}

}
