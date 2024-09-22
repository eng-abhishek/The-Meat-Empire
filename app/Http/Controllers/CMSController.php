<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoodService;
use App\Deal_of_day;
use App\FoodCategory;
use App\Coupon;
class CMSController extends Controller
{
 public function topBarCategoryView(){
  return view('admin.cms.topbarCategory');
 }

 public function exploreByCategoryView(){
  return view('admin.cms.explorerByCategory');
 }

 public function bestSellerView(){
  return view('admin.cms.bestSeller');
 }

 public function dealofDayView(){
  return view('admin.cms.dealofDay');
 }

 public function couponView(){
  return view('admin.cms.coupon');
 }
 public function topBarCategoryStore(Request $request){

 $producval=FoodCategory::where('status','1')->get()->toArray();
   $str=$request->input('product');
   // echo"<pre>";
 foreach ($producval as $key => $productval) {
	if(in_array($productval['id'],$str)){
    // echo "MATCH-".$productval['id']."</br>";
    $update=FoodCategory::find($productval['id']);
    $update->top_bar_cateStatus='1';
    $update->update();
	}else{
    $update=FoodCategory::find($productval['id']);
    $update->top_bar_cateStatus='0';
    $update->update();
	}
 }
return redirect('cms-topbar-category');
 }

 public function exploreByCategoryStore(Request $request){

 $producval=FoodCategory::where('status','1')->get()->toArray();
   $str=$request->input('product');
   // echo"<pre>";
 foreach ($producval as $key => $productval) {
	if(in_array($productval['id'],$str)){
    // echo "MATCH-".$productval['id']."</br>";
    $update=FoodCategory::find($productval['id']);
    $update->home_page_status='1';
    $update->update();
	}else{
    $update=FoodCategory::find($productval['id']);
    $update->home_page_status='0';
    $update->update();
	}
 }
return redirect('cms-explore-by-category');
 }

 public function bestSellerStore(Request $request){

 $producval=FoodService::where('status','1')->get()->toArray();
   $str=$request->input('product');
 foreach ($producval as $key => $productval){
	if(in_array($productval['id'],$str)){
    // echo "MATCH-".$productval['id']."</br>";
    $update=FoodService::find($productval['id']);
    $update->home_page_status='1';
    $update->update();
	}else{
    $update=FoodService::find($productval['id']);
    $update->home_page_status='0';
    $update->update();
	}
 }
return redirect('cms-best-seller');
 }

 public function dealofDayStore(Request $request){
 $producval=Deal_of_day::where('status','1')->get()->toArray();
   $str=$request->input('product');
   // echo"<pre>";
 foreach ($producval as $key => $productval) {
	if(in_array($productval['id'],$str)){
    // echo "MATCH-".$productval['id']."</br>";
    $update=Deal_of_day::find($productval['id']);
    $update->home_page_status='1';
    $update->update();
	}else{
    $update=Deal_of_day::find($productval['id']);
    $update->home_page_status='0';
    $update->update();
	}
 }
return redirect('cms-deal-of-day');
 }

 public function showCouponOnCartPage(Request $request){

 $producval=Coupon::where('status','1')->get()->toArray();
   $str=$request->input('product');
   // echo"<pre>";
 foreach ($producval as $key => $productval) {
  if(in_array($productval['id'],$str)){
    // echo "MATCH-".$productval['id']."</br>";
    $update=Coupon::find($productval['id']);
    $update->cartPageStatus='1';
    $update->update();
  }else{
    $update=Coupon::find($productval['id']);
    $update->cartPageStatus='0';
    $update->update();
  }
 }
return redirect('cms-coupon');
 }


 public function getUpdateDealHomePageStatus(){
 return Deal_of_day::select('id')->where('home_page_status','1')->get()->toArray();
 }

 public function getUpdateBestSellerHomePageStatus(){
 return FoodService::select('id')->where('home_page_status','1')->get()->toArray();
 }

public function getUpdateExploreCategoryHomePageStatus(){
 return FoodCategory::select('id')->where(['home_page_status'=>'1','category_type'=>'ebc'])->get()->toArray();
 }
public function getUpdatetopBarCateStatus(){
 return FoodCategory::select('id')->where('top_bar_cateStatus','1')->get()->toArray();
 }

public function getUpdateCouponCodePageStatus(){
  return Coupon::select('id')->where('cartPageStatus','1')->get()->toArray();
}
}
