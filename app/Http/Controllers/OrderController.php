<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Booking;
use App\Outgoing_product;
use App\Payment_tbl;
use App\FoodService;
use App\Location;
use App\Available_city;
use App\CuttingInstruction;
use DB;
use App;
error_reporting(1);
class OrderController extends Controller
{
  public function getOrder(){
  $order=DB::table('bookings')
      ->select('bookings.id','bookings.order_id','bookings.order_status','bookings.id as bokID','users.f_name','users.l_name','users.email','bookings.bookingDate as delDate','bookings.bookingTime as delTime','bookings.created_at as bokDate')
      ->join('users','bookings.user_id','=','users.id')
      ->orderBy('bookings.id','desc')
      ->get(); 
      return view('admin.order.index',['order'=>$order]);
  } 

  public function getOrderDetail($id){
      $productPrice=array();
      $order=DB::table('bookings')
      ->select('payment_tbls.payment_mode','payment_tbls.transation_id','payment_tbls.total_off','food_services.id as serv_id','payment_tbls.total_amount','bookings.order_id','bookings.id as bokId','bookings.order_status','bookings.id as bokID','users.f_name','users.l_name','users.email','bookings.city','bookings.address','bookings.flat_no','bookings.landmarkAddress','bookings.bookingDate as delDate','bookings.bookingTime as delTime','bookings.created_at as bokDate','bookings.bookingSummary','bookings.expressDelivery','bookings.mobile_no','bookings.clint_msg','bookings.client_rate','bookings.invoice')
      ->join('users','bookings.user_id','=','users.id')
      ->join('outgoing_products','outgoing_products.order_id','=','bookings.id') 
      ->join('food_services','food_services.id','=','outgoing_products.product_id')
      ->join('payment_tbls','payment_tbls.order_id','=','bookings.id')
      
      ->where('bookings.id',$id)
      ->get()->toArray(); 
     
       $productDetails=DB::table('bookings')
       ->select('*')
       ->join('outgoing_products','outgoing_products.order_id','=','bookings.id') 
       ->where('outgoing_products.order_id',$id)
       ->get()
       ->toArray();
       
       $LansMarkAddress=Location::find($order[0]->landmarkAddress)->location_name;
       $city=Available_city::find($order[0]->city)->name;

       foreach ($productDetails as $key => $orderserv) {

        if($orderserv->productType=="fresh"){
        //FoodService::where('id',$orderserv->product_id)->get()->toArray();
         $productPrice[$key]['fresh']=DB::table('food_services')
         ->select('*')
         ->join('product_price_tbls','product_price_tbls.product_id','=','food_services.id')
         ->where('product_price_tbls.id',$orderserv->product_price_id)
         ->get()
         ->toArray();

if($orderserv->cut_inst>0){
         $cuttingInst=CuttingInstruction::find($orderserv->cut_inst)->name;
      
}else{
         $cuttingInst="N/A";
}
         $productPrice[$key]['tax']=$orderserv->tax;
         $productPrice[$key]['count']=$orderserv->qty;
         $productPrice[$key]['cuttingInst']=$cuttingInst;

         }else{

         $productPrice[$key]['deal']=DB::table('deal_of_days')
         ->select('*')
         ->join('dealofdayprice_tbls','dealofdayprice_tbls.product_id','=','deal_of_days.id')
         ->where('dealofdayprice_tbls.id',$orderserv->product_price_id)
         ->get()
         ->toArray();
         $productPrice[$key]['tax']=$orderserv->tax;
         $productPrice[$key]['count']=$orderserv->qty;
        }
        }
 return view('admin.order.orderDetail',['order'=>$order,'productPrice'=>$productPrice,'LansMarkAddress'=>$LansMarkAddress,'city'=>$city]);   
  }

 public function getOrderDetailForUser(Request $req){

      $id=$req->id;
      $productPrice=array();
      $order=DB::table('bookings')
      ->select('payment_tbls.payment_mode','payment_tbls.transation_id','payment_tbls.total_off','food_services.id as serv_id','payment_tbls.total_amount','bookings.order_id','bookings.order_status','bookings.id as bokID','users.f_name','users.l_name','users.email','bookings.city','bookings.address','bookings.flat_no','bookings.landmarkAddress','bookings.bookingDate as delDate','bookings.bookingTime as delTime','bookings.created_at as bokDate','bookings.bookingSummary','bookings.expressDelivery','bookings.mobile_no','bookings.clint_msg','bookings.client_rate')
      ->join('users','bookings.user_id','=','users.id')
      ->join('outgoing_products','outgoing_products.order_id','=','bookings.id') 
      ->join('food_services','food_services.id','=','outgoing_products.product_id')
      ->join('payment_tbls','payment_tbls.order_id','=','bookings.id')
      
      ->where('bookings.id',$id)
      ->get()->toArray(); 
     
       $productDetails=DB::table('bookings')
       ->select('*')
       ->join('outgoing_products','outgoing_products.order_id','=','bookings.id') 
       ->where('outgoing_products.order_id',$id)
       ->get()
       ->toArray();
       
       $LansMarkAddress=Location::find($order[0]->landmarkAddress)->location_name;
       $city=Available_city::find($order[0]->city)->name;

       foreach ($productDetails as $key => $orderserv) {
        if($orderserv->productType=="fresh"){
        //FoodService::where('id',$orderserv->product_id)->get()->toArray();
         $productPrice[$key]['fresh']=DB::table('food_services')
         ->select('*')
         ->join('product_price_tbls','product_price_tbls.product_id','=','food_services.id')
         ->where('product_price_tbls.id',$orderserv->product_price_id)
         ->get()
         ->toArray();


if($orderserv->cut_inst>0){
         $cuttingInst=CuttingInstruction::find($orderserv->cut_inst)->name;
      
}else{
         $cuttingInst="N/A";
}

         $productPrice[$key]['cuttingInst']=$cuttingInst;
         $productPrice[$key]['tax']=$orderserv->tax;
         $productPrice[$key]['count']=$orderserv->qty;
         }else{

         $productPrice[$key]['deal']=DB::table('deal_of_days')
         ->select('*')
         ->join('dealofdayprice_tbls','dealofdayprice_tbls.product_id','=','deal_of_days.id')
         ->where('dealofdayprice_tbls.id',$orderserv->product_price_id)
         ->get()
         ->toArray();
         $productPrice[$key]['tax']=$orderserv->tax;
         $productPrice[$key]['count']=$orderserv->qty;
        }
        }
  
   return view('website.orderHistory',['order'=>$order,'productPrice'=>$productPrice,'LansMarkAddress'=>$LansMarkAddress,'city'=>$city]);  
  }


  public function changeBokStatus(Request $req){
  $bok=Booking::find($req->id);
  $bok->order_status=$req->curStatus;
  $bok->update();
  }

  public function cancelOrder(Request $req){
  $id=$req->id;  
//   $booking=Booking::find($id);
// $currentTime=date('Y-m-d h:i:s');
// $currentStrTime=strtotime($currentTime);
// $endTime = date('Y-m-d h:i:s',strtotime("+35 minutes", strtotime($booking->created_at)));

// if($currentStrTime>strtotime($endTime)){
//  $status=0;
//   return $status;
//  }else{
//  $status=1;
//  $bokDet=Booking::find($id);
//  $bokDet->order_status='cancel';
//  $bokDet->update();
//  return $status;
//   }

 $status=1;
 $bokDet=Booking::find($id);
 $bokDet->order_status='cancel';
 $bokDet->update();
 return $status;
}

public function getInvoice($id){
 
      $productPrice=array();
      $order=DB::table('bookings')
      ->select('payment_tbls.payment_mode','payment_tbls.transation_id','payment_tbls.total_off','food_services.id as serv_id','payment_tbls.total_amount','bookings.order_id','bookings.order_status','bookings.id as bokID','users.f_name','users.l_name','users.id as customerId','users.email','bookings.city','bookings.address','bookings.flat_no','bookings.landmarkAddress','bookings.bookingDate as delDate','bookings.bookingTime as delTime','bookings.created_at as bokDate','bookings.bookingSummary','bookings.expressDelivery','bookings.mobile_no','bookings.clint_msg','bookings.client_rate')
      ->join('users','bookings.user_id','=','users.id')
      ->join('outgoing_products','outgoing_products.order_id','=','bookings.id') 
      ->join('food_services','food_services.id','=','outgoing_products.product_id')
      ->join('payment_tbls','payment_tbls.order_id','=','bookings.id')
      
      ->where('bookings.id',$id)
      ->get()->toArray(); 
     
       $productDetails=DB::table('bookings')
       ->select('*')
       ->join('outgoing_products','outgoing_products.order_id','=','bookings.id') 
       ->where('outgoing_products.order_id',$id)
       ->get()
       ->toArray();
       
       $LansMarkAddress=Location::find($order[0]->landmarkAddress)->location_name;
       $city=Available_city::find($order[0]->city)->name;

       foreach ($productDetails as $key => $orderserv) {
        if($orderserv->productType=="fresh"){
        //FoodService::where('id',$orderserv->product_id)->get()->toArray();
         $productPrice[$key]['fresh']=DB::table('food_services')
         ->select('*')
         ->join('product_price_tbls','product_price_tbls.product_id','=','food_services.id')
         ->where('product_price_tbls.id',$orderserv->product_price_id)
         ->get()
         ->toArray();

if($orderserv->cut_inst>0){
         $cuttingInst=CuttingInstruction::find($orderserv->cut_inst)->name;
      
}else{
         $cuttingInst="N/A";
}

         $productPrice[$key]['cuttingInst']=$cuttingInst;
         $productPrice[$key]['tax']=$orderserv->tax;
         $productPrice[$key]['count']=$orderserv->qty;
         }else{

         $productPrice[$key]['deal']=DB::table('deal_of_days')
         ->select('*')
         ->join('dealofdayprice_tbls','dealofdayprice_tbls.product_id','=','deal_of_days.id')
         ->where('dealofdayprice_tbls.id',$orderserv->product_price_id)
         ->get()
         ->toArray();
         $productPrice[$key]['tax']=$orderserv->tax;
         $productPrice[$key]['count']=$orderserv->qty;
        }
        }

      $pdfname = 'invoice'.$id.'.pdf';
      $pdf=App::make('dompdf.wrapper');
      return $pdf->loadView('website.new_invoice',['order'=>$order,'productPrice'=>$productPrice,'LansMarkAddress'=>$LansMarkAddress,'city'=>$city])->save(public_path().'/uploads/invoices/'.$pdfname)->stream('hkd.pdf');
}
}
