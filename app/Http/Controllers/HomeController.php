<?php
namespace App\Http\Controllers;
use App\Home;
use App\FoodService;
use App\Available_city;
use App\FoodCategory;
use App\Deal_of_day;
use App\Testimonial;
use App\Location;
use App\Dealofdayprice_tbl;
use Illuminate\Http\Request;
use DB;
use session;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }
              $productItem=DB::table('product_cities')
              
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('food_categories','food_services.service_cate_id','=','food_categories.id')
               ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')
               ->where(['product_cities.city_id'=>$selectCity,'food_services.home_page_status'=>1])->take(6)
               ->select('product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_categories.category_name','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
               ->groupBy('product_price_tbls.product_id')
               ->get()->toArray();
              $firstSlider=count($productItem);
// echo"<pre>";
// print_r($productItem);
// die;
              $productItemAfterSix=DB::table('product_cities')
              
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('food_categories','food_services.service_cate_id','=','food_categories.id')
              ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id') 
              ->where(['product_cities.city_id'=>$selectCity,'food_services.home_page_status'=>1])->take(6)->skip(6)
              ->select('product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_categories.category_name','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
              ->groupBy('product_price_tbls.product_id')
             ->get()->toArray();
              $secondSlider=count($productItemAfterSix);



               $productItemAfterEightTeen=DB::table('product_cities')
              
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('food_categories','food_services.service_cate_id','=','food_categories.id')
              ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id') 
              ->where(['product_cities.city_id'=>$selectCity,'food_services.home_page_status'=>1])->take(6)->skip(12)
              ->select('product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_categories.category_name','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
              ->groupBy('product_price_tbls.product_id')
             ->get()->toArray();
              $thirdSlider=count($productItemAfterEightTeen);



               $productItemAftertwentiFour=DB::table('product_cities')
              
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('food_categories','food_services.service_cate_id','=','food_categories.id')
              ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id') 
              ->where(['product_cities.city_id'=>$selectCity,'food_services.home_page_status'=>1])->take(6)->skip(18)
              ->select('product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_categories.category_name','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
              ->groupBy('product_price_tbls.product_id')
             ->get()->toArray();
              $fourthSlider=count($productItemAftertwentiFour);
// echo"<pre>";
// print_r($productItemAfterSix);
// die;

$arrayDealOfDayData=array();
$dealofDay=Deal_of_day::select('deal_of_days.foodName','deal_of_days.offer','deal_of_days.offer','deal_of_days.productImg','deal_of_days.id')->where('status','1')->get()->toArray();
foreach ($dealofDay as $Dkey => $dealofDayvalue){
$arrayDealOfDayData[]=$dealofDayvalue;
$dealofDayPrice=Dealofdayprice_tbl::select('dealofdayprice_tbls.quantity','dealofdayprice_tbls.quantity_type','dealofdayprice_tbls.price','dealofdayprice_tbls.type')->where('product_id',$dealofDayvalue['id'])->get()->toArray();
foreach($dealofDayPrice as $DPkey=>$dealofDayPricevalue){
$arrayDealOfDayData[$Dkey]['price_tbl'][]=$dealofDayPricevalue;

}
}

     $productCategory=FoodCategory::where(array('home_page_status'=>'1','category_type'=>'ebc'))->take(12)->skip(0)->get()->toArray();
     
     $productCategorythirdrow=FoodCategory::where(array('home_page_status'=>'1'))->take(2)->skip(8)->get();

     $testimonial=Testimonial::where(array('status'=>'1'))->get();

    return view('website.index',['secondSlider'=>$secondSlider,'firstSlider'=>$firstSlider,'productItem'=>$productItem,'productCategory'=>$productCategory,'productCategorythirdrow'=>$productCategorythirdrow,'productDealOfDay'=>$arrayDealOfDayData,'productItemAfterSix'=>$productItemAfterSix,'testimonial'=>$testimonial,'productItemAfterEightTeen'=>$productItemAfterEightTeen,'thirdSlider'=>$thirdSlider,'productItemAftertwentiFour'=>$productItemAftertwentiFour,'fourthSlider'=>$fourthSlider]);
    }

   public function productByCity(Request $req){
    session()->forget('location');
   // return $req->input();
    $id=$req->id;
    $orderDate=$req->date;
    $orderTime=$req->time;

    session()->put('location',$req->location);
    session()->put('orderDate',$orderDate);
    session()->put('orderTime',$orderTime);
    
    // echo session()->get('orderTime');
    // die;
   $getCityName=Available_city::find($id);
   $city=$getCityName->id;
   session()->forget('checkExpressDelivery');
session()->forget('new_apply_coupon_process');
   session()->forget('tatalPayAMT');
   session()->forget('special_cart');
   session()->forget('cart');
   session()->put('city',$city);
   return redirect('/');
   }

   public function checkcityCategory(Request $req){
    $returnType=array();

    $getCityName=Available_city::find($req->id);
    
    $cityLocation=Location::where('cate_id',$getCityName->id)->get();

    $output='';
    $output.='<select name="location" class="form-control location-input pac-target-input" autocomplete="off">';
    $output.='<option value="">Select Location</option>';
    foreach($cityLocation as $cityLocationval) {
    $output.='<option value="'.$cityLocationval->id.'">'.$cityLocationval->location_name.'</option>';
    }
    $output.='<select>'; 

    $returnType[1]=$output;

    $getCityName->category;
    if($getCityName->category=="C"){
    $status=0;
    // return $status;
    }else{
    $status=1;
    // return $status;
    }

$returnType[0]=$status;

return $returnType;
   }
   
public function getSelectedSector(Request $req){
   
   $setlocation=session()->get('location');

   $cityLocation=location::where('cate_id',$req->id)->get();

    $output='';
    $output.='<select name="location" class="form-control location-input pac-target-input" autocomplete="off"><option value="">Select Location</option>';
    foreach($cityLocation as $cityLocationval) {
    if($setlocation==$cityLocationval->id){
      $setval="selected";
      }else{
      $setval=""; 
      }    
    $output.='<option '.$setval.' value="'.$cityLocationval->id.'">'.$cityLocationval->location_name.'</option>';
    }
    $output.='<select>'; 
   return $output;
    }


   public function userlogin($type=''){
   if($type){
    session()->put('checkoutToAddress',$type);
            }
   if(session()->get('loginEmail')){
   return redirect('user-address');
   }else{
    return view('website.login');
   }



   }   

   public function privacypolicy(){
   return view('website.privacypolicy');
  }
  
   public function termscondition(){
   return view('website.termscondition');
  }

   public function searchProduct(){
   session()->put('search','search'); 
   return view('website.search_product');
  }

  public function getProductCategory(){
    $category=FoodCategory::where(array('top_bar_cateStatus'=>'1'))->get();
    $output='';
    $output.='<div class="row text-center">';

    foreach($category as $categorydata){
     $url=url('category-product/'.$categorydata->id);
     $img=url('uploads/foodCategoryLogo/'.$categorydata->category_logo);

     $output.='<div class="col-md-3 col-sm-3 mt-20">';
     $output.='<div>';
     $output.='<a href="'.$url.'"><img style="height:80px;weight:80px" class="img-responsive" src="'.$img.'"></img></a></div>';
     $output.='<div class="">';
     $output.='<a style="text-decoration:none;" href="'.$url.'"><h5 style="color:black" align="center">'.$categorydata->category_name.'</h5></a></div>';

     $output.='</div>';
       }
    $output.='</div>';
    return $output;
  }

    public function getSearchProduct(Request $req){
     $searchItem=$req->input('searchItem');
     if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }
              $productItem=DB::table('product_cities')
              
                  ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('food_categories','food_services.service_cate_id','=','food_categories.id')
               ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')
               ->where(['product_cities.city_id'=>$selectCity,'food_services.status'=>1])->where('food_services.service_name', 'LIKE', "%{$searchItem}%")
               ->select('food_services.service_offer','product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_categories.category_name','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer','food_services.service_offer')
                ->groupBy('product_price_tbls.product_id')
                ->get()->toArray();

    $output='';
    $output.='<div class="row">';

    foreach($productItem as $categorydata){
    $actPrice=($categorydata->price/100)*$categorydata->service_offer;
    $netprice=$categorydata->price-$actPrice;
     $cutprice=$categorydata->price;    
     $reflectURL=url('product-detail/'.$categorydata->id);
     $url=$categorydata->id;
     $qtyType=settype($categorydata->quantity_type,"string");
     
     $img=url('uploads/foodService/'.$categorydata->service_img);
     $output.='<div class="col-sm-4 mt-20">';
     $output.='<div class="productcardcat">';
     $output.='<a href="'.$reflectURL.'"><img src="'.$img.'"></img></a>';
     $output.='<div class="item-details">';
 
     $output.='<a href="javascript:void(0)" class="productlink"> <h5>'.$categorydata->service_name.'</h5></a>';
     $output.='<span class="ntweight">Net  : '.$categorydata->quantity.' '.$categorydata->quantity_type.'</span>';
     $output.='<a class="addcart" onclick="addToCart('.$url.','.$categorydata->quantity.','.$qtyType.')" href="javascript:void(0)" class="dealaddtocard">Add To Cart</a>';    
     $output.='<span class="mrp"> <i class="fa fa-inr" aria-hidden="true"></i>' .$netprice.'</span>';
         $output.='<del class="smrp" style="color:gray"><i class="fa fa-inr" aria-hidden="true"></i>'.$cutprice.'</del>';
     $output.='</div>'; 
      
     $output.='</div></div>';
    }
    $output.='</div>';
    return $output;
    }
}
