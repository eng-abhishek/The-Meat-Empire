<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Booking;
use App\Payment_tbl;
use App\Outgoing_product;
use DB;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;


class ReportController extends Controller
{
    public function bookingReport(Request $req){

 if($req->fromDate){
       $order=DB::table('bookings')
      ->select('bookings.bookingDate as delDate','bookings.bookingTime as delTime','bookings.created_at as bokDate','bookings.order_id','bookings.order_status','bookings.id as bokID','users.f_name','users.l_name','users.email')
      ->join('users','bookings.user_id','=','users.id')
      ->whereBetween('bookings.created_at',[$req->fromDate,$req->toDate])
      ->orderBy('bookings.id','desc')
      ->get(); 
      return view('admin.report.booking',['order'=>$order]);

 }else{

   $order=DB::table('bookings')
      ->select('bookings.bookingDate as delDate','bookings.bookingTime as delTime','bookings.created_at as bokDate','bookings.order_id','bookings.order_status','bookings.id as bokID','users.f_name','users.l_name','users.email')
      ->join('users','bookings.user_id','=','users.id')
      ->orderBy('bookings.id','desc')
      ->get(); 
      return view('admin.report.booking',['order'=>$order]);

 }
    }
 

    public function bookingReportExcel(){
     
     return Excel::download(new ProductExport,'orderReport.xlsx');

    } 

    public function paymentReport(Request $req){
    if($req->fromDate){
     // return $req->input();
      $payment=DB::table('bookings')
      ->select('bookings.order_id','bookings.order_status','bookings.id as bokID','users.f_name','users.l_name','users.email','payment_tbls.total_amount','payment_tbls.created_at')
      ->join('payment_tbls','bookings.id','=','payment_tbls.order_id')
      ->join('users','bookings.user_id','=','users.id')
       ->orderBy('payment_tbls.id','desc')
      ->whereBetween('payment_tbls.created_at',[$req->fromDate,$req->toDate])
      ->get(); 
       return view('admin.report.payment',['order'=>$payment]);

    }else{

      $payment=DB::table('bookings')
      ->select('bookings.order_id','bookings.order_status','bookings.id as bokID','users.f_name','users.l_name','users.email','payment_tbls.total_amount','payment_tbls.created_at')
      ->join('payment_tbls','bookings.id','=','payment_tbls.order_id')
      ->join('users','bookings.user_id','=','users.id')
      ->orderBy('payment_tbls.id','desc')
      ->get(); 
       return view('admin.report.payment',['order'=>$payment]);

    }

    }


    public function paymentReportExcel(){

    return Excel::download(new PaymentExport,'paymentReport.xlsx');

    }

}



class ProductExport implements FromCollection
{
	public function collection(){
   return $order=DB::table('bookings')
      ->select('bookings.order_id','bookings.order_status','bookings.id as bokID','users.f_name','users.l_name','users.email')
      ->join('users','bookings.user_id','=','users.id')
      ->orderBy('bookings.id','desc')
      ->get(); 
	}

}

class PaymentExport implements FromCollection
{
  public function collection(){
   return   $payment=DB::table('bookings')
      ->select('bookings.order_id','users.f_name','users.l_name','payment_tbls.total_amount','payment_tbls.created_at')
      ->join('payment_tbls','bookings.id','=','payment_tbls.order_id')
      ->join('users','bookings.user_id','=','users.id')
      ->orderBy('payment_tbls.id','desc')
      ->get(); 
  }

}