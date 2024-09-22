<?php
namespace App\Http\Controllers;
error_reporting(1);
use App\Coupon;
use Illuminate\Http\Request;
use App\Booking;
use App\User;
use DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generalCoupon=Coupon::orderBy('id','desc')->get();
        $userCoupon=DB::table('coupons')
        ->select('coupons.min_order_amount','coupons.coupon_name_details','coupons.price_type','coupons.couponType','coupons.name','coupons.id','coupons.status','coupons.off_price','users.f_name as ufname','users.l_name as ulname')
        ->join('users','coupons.user_id','=','users.id')
        ->where('coupons.used_coupon_status','1')
        ->orderBy('coupons.id','desc')
        ->get();

        return view('admin.coupon.index',['coupon'=>$userCoupon,'bookingCancel'=>$bookingCancel,'generalCoupon'=>$generalCoupon]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookingCancel=DB::table('bookings')
        ->join('users','bookings.user_id','=','users.id')
        ->where('bookings.order_status','cancel')
        ->groupBy('bookings.user_id')    
        ->select('users.f_name','users.l_name','users.id')
        ->get();
    return view('admin.coupon.view',['userDetails'=>$bookingCancel]); 
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
            'couponCode' =>'required',
            'couponOffer' =>'required|integer',

            // 'startDate'=>'required',
            // 'endDate'=>'required',
                               ]); 
        $sreq = new Coupon;
        $sreq->name=$request->couponCode; 
        $sreq->off_price=$request->couponOffer; 
        $sreq->couponType=$request->couponType;
        $sreq->user_id=$request->user_id; 

        $sreq->coupon_name_details=$request->coupon_name_details; 
        $sreq->price_type=$request->price_type; 
        $sreq->min_order_amount=$request->minOrderAmount; 
    
        // $sreq->end_date=$request->endDate; 
        $sreq->save();        
        \Session::put('success','Data Add Successfully.');
        return redirect('/coupon'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $editData=Coupon::find($id);
     $bookingCancel=DB::table('bookings')
        
        ->join('users','bookings.user_id','=','users.id')
        ->where('bookings.order_status','cancel')
        ->groupBy('bookings.user_id')    
        ->select('users.f_name','users.l_name','users.id')
        ->get();
    
     return view('admin.coupon.edit',['editData'=>$editData,'userDetails'=>$bookingCancel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $id=$request->editId;
         $request->validate([
            'couponCode' =>'required',
            'couponOffer' =>'required|integer',
            // 'startDate'=>'required',
            // 'endDate'=>'required',
                     ]); 
        $sreq =Coupon::find($id);
     
        $sreq->name=$request->couponCode; 
        $sreq->off_price=$request->couponOffer; 
        $sreq->user_id=$request->user_id; 
        $sreq->couponType=$request->couponType;
        $sreq->coupon_name_details=$request->coupon_name_details; 
        $sreq->price_type=$request->price_type; 
        $sreq->min_order_amount=$request->minOrderAmount; 
        // $sreq->start_date=$request->startDate; 
        // $sreq->end_date=$request->endDate; 
        $sreq->update();  
        \Session::put('success','Data Update Successfully.');
        return redirect('/coupon'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     Coupon::where('id',$id)->delete();
       \Session::put('warning','Data Remove Successfully.');
    return redirect('/coupon'); 
    }

   public function updateCouponStatus(Request $request){
            $uDocData=Coupon::find($request->input('id'));
            $uDocData->status=$request->CatStatus;
            $uDocData->update();
   }

    public function alloffer(Request $request){
      $alloffer=Coupon::orderBy('id','desc')->where('status','1')->get();
          
        // $loginEmail=session()->get('loginEmail');
        // $userDetails=User::where('email',$loginEmail)->get()->toArray();
        // $uId=$userDetails[0]['id'];
        // $alloffer=Coupon::where(['user_id'=>$uId,'used_coupon_status'=>'1','status'=>'1'])->get();

        return view('website.offer',['alloffer'=>$alloffer]);    
    }


}
