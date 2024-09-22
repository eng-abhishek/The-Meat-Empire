<?php

namespace App\Http\Controllers;
error_reporting(1);
use App\Cart;

use App\FoodService;
use App\FoodCategory;
use Illuminate\Http\Request;
use App\Product_price_tbl;
use App\Deal_of_day;
use App\Dealofdayprice_tbl;
use App\HappyHoursDicount;
use App\SignupDiscount;
use App\Discount;
use App\Coupon;
use App\Available_city;
use App\CuttingInstruction;
use App\LaunchingDiscount;
use App\Booking;
use App\User;
use App\SignupDicount;
use App\UsedPromoCode;
use App\Payment_tbl;
use App\Outgoing_product;
use App\MinOrderAmount;
use Session;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
     
     $sideAddons=FoodCategory::where('id',"78")->get();    
    
             if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }
              $foodData=DB::table('product_cities')
            
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('food_categories','food_services.service_cate_id','=','food_categories.id')
                ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')
                ->where(['product_cities.city_id'=>$selectCity,'food_services.service_cate_id'=>$sideAddons[0]->id])
                ->select('food_services.service_cate_id','product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_categories.category_name','food_services.service_short_des','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
                  ->groupBY('product_price_tbls.product_id')
                  ->get()->toArray();
                  return view('website.cart',['foodData'=>$foodData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
        public function checkProductCate($productId){
       $foodData=FoodService::find($productId);
       $chkProductCater=FoodCategory::find($foodData->service_cate_id);
      if($chkProductCater->category_name=="side & addons"){
       return 10;
      }else{
       
      }       
   }

    public function addToCart(Request $request)
    {
        // return $request->input();
        
        $checkProductCate=$this->checkProductCate($request->id); 
if($checkProductCate=="10"){
return $checkProductCate;
}else{

$avaliableQty=$this->checkStockAvaliablity($request->id,$request->qty,$request->qtyType,$request->type);

if($avaliableQty=='0'){
 $status="0";
 return $status;
}else{

$id=$request->id;
$type=$request->type;

if($type){
$product = Deal_of_day::find($id);

        $productId=$product->id;
        $productPrice=Dealofdayprice_tbl::where('product_id',$productId)->get()->toArray();
if($productPrice[0]['price']>1){
        $offprice=$productPrice[0]['price']-($productPrice[0]['price']/100)*($product->offer);
}else{
        $offprice=$productPrice[0]['price'];
}

        if(!$product) {
            abort(404); 
        }
 
        $cart = session()->get('special_cart');
        // if cart is empty then this the first product
        if(!$cart) {
        
            $cart = [
                    $id => [
                         "count"=>1,
                         "name" => $product->foodName,
                         "quantity" => $productPrice[0]['quantity'],
                         "quantity_type" => $productPrice[0]['quantity_type'],
                         "type" => $productPrice[0]['type'],
                         "price" => $offprice,
                         "photo" => $product->productImg,
                         "productType"=>"deal",
                         "productId"=>$productPrice[0]['product_id'],
                         "price_tbl_id"=>$productPrice[0]['id'],
                    ]
                    ];

         session()->put('special_cart', $cart);
        // return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

       $cart[$id] = [
                         "count"=>1,  
                         "name" => $product->foodName,
                         "quantity" => $productPrice[0]['quantity'],
                         "quantity_type" => $productPrice[0]['quantity_type'],
                        "type" => $productPrice[0]['type'],
                        "price" => $offprice,
                        "photo" => $product->productImg,
                        "productType"=>"deal",
                        "productId"=>$productPrice[0]['product_id'],
                        "price_tbl_id"=>$productPrice[0]['id'],
                    
                  ];

         session()->put('special_cart', $cart);




// return redirect()->back()->with('success', 'Product added to cart successfully!');

}else{

        $product = FoodService::find($id);
        $productId=$product->id;
        $productPrice=Product_price_tbl::where('product_id',$productId)->get()->toArray();

        $offprice=$productPrice[0]['price']-($productPrice[0]['price']/100)*($product->service_offer);
  
        if(!$product) {
            abort(404); 
        }
 
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart) {
        
            $cart = [
                    $id => [
                         "count"=>1,
                         "name" => $product->service_name,
                         "quantity" => $productPrice[0]['quantity'],
                         "quantity_type" => $productPrice[0]['quantity_type'],
                         "type" => $productPrice[0]['type'],
                         "price" => $offprice,
                         "photo" => $product->service_img,
                         "productType"=>"fresh",
                         "productId"=>$productPrice[0]['product_id'],
                         "tax"=>$product->tax,
                         "cuttingInst"=>$request->cuttingInst,
                         "price_tbl_id"=>$productPrice[0]['id'],
                    ]
                    ];

         session()->put('cart', $cart);
       //  return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
 
       $cart[$id] = [
                         "name" => $product->service_name,
                         "count"=>1, 
                         "quantity" => $productPrice[0]['quantity'],
                         "quantity_type" => $productPrice[0]['quantity_type'],
                         "type" => $productPrice[0]['type'],
                        "price" => $offprice,
                        "photo" => $product->service_img,
                        "productType"=>"fresh",
                        "productId"=>$productPrice[0]['product_id'],
                        "tax"=>$product->tax,
                        "cuttingInst"=>$request->cuttingInst,
                        "price_tbl_id"=>$productPrice[0]['id'],
                   ];

         session()->put('cart', $cart);
         // echo"<pre>";
        // print_r(session('cart')); 
       //  return redirect()->back()->with('success', 'Product added to cart successfully!');

     }  
     }       // return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    }

/*--------------- cart function for Product Page ------------*/

  public function addToCartAtProductPage(Request $request){
  // return $request->input();

$checkProductCate=$this->checkProductCate($request->id); 
if($checkProductCate=="10"){
return $checkProductCate;
}else{

  $pricetbl=Product_price_tbl::find($request->priceId);
  $avaliableQty=$this->checkStockAvaliablity($request->id,$pricetbl->quantity,$pricetbl->quantity_type,$request->type);

if($avaliableQty=='0'){
 $status="0";
 return $status;
}else{

        $id=$request->id;
        $PriceTblID=$request->priceId;
        $product = FoodService::find($id);
        $productId=$product->id;
        $productPrice=Product_price_tbl::where('product_id',$productId)->where('id',$PriceTblID)->get()->toArray();

        $offprice=$productPrice[0]['price']-($productPrice[0]['price']/100)*($product->service_offer);

        if(!$product) {
            abort(404); 
        }

       $cart = session()->get('cart');

        if(!$cart) {
        
            $cart = [
                    $id => [
                         "count"=>1,
                         "name" => $product->service_name,
                         "quantity" => $productPrice[0]['quantity'],
                         "quantity_type" => $productPrice[0]['quantity_type'],
                         "type" => $productPrice[0]['type'],
                         "price" => $offprice,
                         "photo" => $product->service_img,
                         "productType"=>"fresh",
                         "productId"=>$productPrice[0]['product_id'],
                         "cuttingInst"=>$request->cuttingInst,
                         "price_tbl_id"=>$productPrice[0]['id'],
                    ]
                    ];

         session()->put('cart', $cart);
        // return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
       
               $cart[$id] = [
                         "name" => $product->service_name,
                         "count"=>1, 
                         "quantity" => $productPrice[0]['quantity'],
                         "quantity_type" => $productPrice[0]['quantity_type'],
                         "type" => $productPrice[0]['type'],
                        "price" => $offprice,
                        "photo" => $product->service_img,
                        "productType"=>"fresh",
                        "productId"=>$productPrice[0]['product_id'],
                        "cuttingInst"=>$request->cuttingInst,
                        "price_tbl_id"=>$productPrice[0]['id'],
                   ];
               session()->put('cart', $cart);
}
}  
     //    return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

public function showqtyPriceProductPage(Request $req){
    $price=array();
    $tbrawPrice=Product_price_tbl::find($req->id);
    $rawPrice=$tbrawPrice->price;

    $price[0]=$rawPrice;

    $serviceId=FoodService::find($req->productId);
    
    $offprice=($rawPrice/100)*$serviceId->service_offer;
     
    $actualAmount=ceil($rawPrice)-ceil($offprice);
    $price[1]=$actualAmount;
    
    return $price;
}

/*--------------- end cart function for Product Page ------------*/

public function countCart(Request $req){
         $id=$req->id;
         $cart=session()->get('cart');
         $count=$cart[$id]['count']++;

         $availableStock=$cart[$id]['quantity']*$count;

         $productId=$cart[$id]['productId'];
         
if($cart[$id]['quantity_type']=="kilo-gram"){
$chkavailableStock=$availableStock*1000;
}else{
$chkavailableStock=$availableStock;
}

$oldStock=FoodService::find($productId)->stock;
if($oldStock>$chkavailableStock){
  session()->put('cart', $cart);
  $status=1;
  return $status;  
    }else{
  $status=0;
  return $status; 
    }

       //return redirect()->back()->with('success', 'Product added to cart successfully!');
}
public function decrise_countCart(Request $req){
          $id=$req->id;
         $cart=session()->get('cart');
         if($cart[$id]['count']>1){
         $cart[$id]['count']--;
          }
         session()->put('cart', $cart);
        // return redirect()->back()->with('success', 'Product added to cart successfully!');
}


public function countCartProductPage(Request $req){
         $id=$req->Cartkey; 
         $cart=session()->get('cart');
         $cart[$id]['count']++;
         session()->put('cart', $cart);
        // return redirect()->back()->with('success', 'Product added to cart successfully!');
}

public function decrise_countCartProductPage(Request $req){
         $id=$req->Cartkey;
         $cart=session()->get('cart');
         if($cart[$id]['count']>1){
         $cart[$id]['count']--;
          }
         session()->put('cart', $cart);
         //return redirect()->back()->with('success', 'Product added to cart successfully!');
}


/*----------- Deal of Day --------*/

public function special_countCart(Request $req){
         $id=$req->id;
         $cart=session()->get('special_cart');
         $count=$cart[$id]['count']++;

         $availableStock=$cart[$id]['quantity']*$count;

         $productId=$cart[$id]['productId'];
         
if($cart[$id]['quantity_type']=="kilo-gram"){
$chkavailableStock=$availableStock*1000;
}else{
$chkavailableStock=$availableStock;
}

$oldStock=Deal_of_day::find($productId)->stock;

if($oldStock>$chkavailableStock){
session()->put('special_cart', $cart);
  $status=1;
  return $status;  
    }else{
  $status=0;
  return $status; 
    }
}
public function special_decrise_countCart(Request $req){
         $id=$req->id;
         $cart=session()->get('special_cart');
         if($cart[$id]['count']>1){
         $cart[$id]['count']--;
          }
         session()->put('special_cart', $cart);
        // return redirect()->back()->with('success', 'Product added to cart successfully!');
}
/*---------Deal of Day---------*/

public function updateProductCart(Request $req){
// $productid=$req->productId;
$pricetblid=$req->PriceTblid;

 $id=$req->productId;
 $cart = session()->get('cart');

  $product = FoodService::find($id);

 $productPrice=Product_price_tbl::where('id',$pricetblid)->get()->toArray();

 $offprice=$productPrice[0]['price']-($productPrice[0]['price']/100)*($product->service_offer);
    

      $cart[$id]['quantity']=$productPrice[0]['quantity'];
      $cart[$id]['quantity_type']=$productPrice[0]['quantity_type'];
      $cart[$id]['price']=$offprice;
      $cart[$id]['price_tbl_id']=$productPrice[0]['id'];
         session()->put('cart', $cart);
}


public function updateSpeProductCart(Request $req){

$id=$req->productId;
$pricetblid=$req->PriceTblid;

 $cart = session()->get('special_cart');

  $product = Deal_of_day::find($id);
 $productPrice=Dealofdayprice_tbl::where('id',$pricetblid)->get()->toArray();
if($productPrice[0]['price']>0){
 $offprice=$productPrice[0]['price']-($productPrice[0]['price']/100)*($product->offer);

}else{
 $offprice=$productPrice[0]['price'];
}
      $cart[$id]['quantity']=$productPrice[0]['quantity'];
      $cart[$id]['quantity_type']=$productPrice[0]['quantity_type'];
      $cart[$id]['price']=$offprice;
      $cart[$id]['price_tbl_id']=$productPrice[0]['id'];

         session()->put('special_cart', $cart);
         return redirect('cart');
}

public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
 
            $cart[$request->id]["quantity"] = $request->quantity;
 
            session()->put('cart', $cart);
 
            session()->flash('success', 'Cart updated successfully');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
                                           }
 
            session()->flash('success', 'Product removed successfully');
                        }
    }


    public function removeSpecialProductPriceItem(Request $request){
           if($request->id) {
 
            $cart = session()->get('special_cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('special_cart', $cart);
                                           }
 
            session()->flash('success', 'Product removed successfully');
                        }
    }
    
     public function checkCoupon(Request $request){
//echo $request->totalAmount;

       $coupon=Coupon::find($request->couponId);
// echo $coupon->off_price;

      if($coupon->name==$request->coupon){      
       $actualAmount=$request->totalAmount-($request->totalAmount/100)*$coupon->off_price;
       session()->put('actualAmount',$actualAmount);

      return view('website.cart',['actualAmount'=>$actualAmount]);

      }else{
      Session::flash('coupon_err', 'Please Enter Valide Coupon Code');
      return redirect('cart');
      }
     }

/*------ getCartCount -------*/
public function getCartCount(){
 $val1=count(session('cart'));
 $val2=count(session('special_cart'));
 return $val1+$val2;
}


public function checkStockAvaliablity($id,$qty,$qtyType,$type=''){

if($type){
$storeItem=Deal_of_day::find($id);

if($qtyType=='kilo-gram'){
     $avalQty=$qty*1000;
   }else{
     $avalQty=$qty;
   }
if(ceil($storeItem->stock)>=ceil($avalQty)){
return 1;
}else{
return 0;
}

    }else{

$storeItem=FoodService::find($id);
   if($qtyType=='kilo-gram'){
     $avalQty=$qty*1000;
   }else{
     $avalQty=$qty;
   }
if(ceil($storeItem->stock)>=ceil($avalQty)){
return 1;
}else{
return 0;
}
} 
}

public  function cartDetails()
{
$result=array();
$output='';
 
 if(session('cart')){
 foreach(session('cart') as $id => $details){

 $pricetbl=Product_price_tbl::where('product_id',$id)->get()->toArray();

 $total += $details['price']*$details['count'];

 $porductImg=asset('uploads/foodService/'.$details['photo']);
if($details['tax']>0){
$tax=$details['tax'];
}else{
$tax='N/A';
}

 $output.='<div class="row cartdiv">
                        <div class="col-md-2 p0">
                             <img src="'.$porductImg.'" width="100%" style="height:80px">
                        </div>
                        <div class="col-md-10" >
                           
                            <div class="row" style="border-bottom:1px solid silver;padding-bottom:10px;padding-right:20px">
                        <div class="col-md-2 cart-product pt-10" >
                              <h5>'.$details['name'].'</h5>
                              <span>Nett: '.$details['quantity'].' '.$details['quantity_type'].'</span>
                              <h6 class="famount"><i class="fa fa-inr" aria-hidden="true"></i>'.$details['price'].'</h6>
                        </div>  

                                       <div class="col-md-2 weight-cart pt-10">
                        <h5>Cutting Instructions</h5>';

   $foodId=FoodService::find($details['productId']);
  if($foodId->cutting_instruction){

  $output.='<select class="form-control p0" data-th="Quantity">';
  $CutID=explode(',',$foodId->cutting_instruction);
  for($m=0; $m < count($CutID); $m++) { 
  $CutingData=CuttingInstruction::where('id',$CutID[$m])->get();
   foreach ($CutingData as $cutvalue) {

   $output.='<option'; if($cutvalue->id==$details['cuttingInst']){ 
   $output.=' selected ';
   }else{ 
   $output.=' ';
         }   
   $output.='value="'.$cutvalue->id.'">';
   $output.=$cutvalue->name.'</option>';
   }
   }
   
    $output.='</select>';
    }else{ 
    $output.='<font style="font-size:12px">N/A</font>';
          }

    $output.='</div>

                        <div class="col-md-2 weight-cart pt-10">
                              <h5 style="margin-bottom:18px">Quantity</h5>
                              <select class="form-control dropdownQty p0" onchange="changeProductQty('.$id.',this.value)" product-id="'.$id.'">';
                              foreach($pricetbl as $pricetblData){   
 $output.='<option '; if( ($details['quantity_type']==$pricetblData['quantity_type']) && ($details['quantity']==$pricetblData['quantity'])) {

 $output.=' selected ';

  }else{  
 $output.='';
  }

 $output.=' value="'.$pricetblData['id'].'">';
 $output.=$pricetblData['quantity'].' '.$pricetblData['quantity_type'].'
                                  </option>';
                                                       }
 $output.='</select>
                        </div>  
                        <input type="text" name="productPrice" hidden value="'.$details['price'].'">

           <div class="col-md-1 weight-cart pt-10">
                        <h5 style="margin-bottom:12px">Tax(%)</h5>
                       <p class="pt-10">'.$tax.'</p>
                    </div>
        
    
    <div class="col-md-2 quant-cart pt-8">
              <h5 class="text-left" style="margin-bottom:12px">Add More </h5>
              <div class="input-group pt-8">
              <span class="input-group-btn">
              <button type="button" class="plus-btn" onclick="decriseProductCount('.$id.')" data-type="minus" data-field="quant[1]">
                  <i class="fa fa-minus" aria-hidden="true"></i>
              </button>
          </span>
          <input type="text" name="quant[1]" readonly style="background-color:#fff;padding:0px" class="form-control input-number " value="'.$details['count'].'">
          <span class="input-group-btn">
              <button type="button" onclick="increaseProductCount('.$id.')" class="minus-btn" data-type="plus" data-field="quant[1]">
                <i class="fa fa-plus" aria-hidden="true"></i>
              </button>
          </span>
      </div>
     </div>

                <div class="col-md-2 weight-cart pt-10">
                        <h5 style="margin-bottom:12px">Amount</h5>
                      <p class="famountprice pt-10"><i class="fa fa-inr" aria-hidden="true"></i>'.$details['price']*$details['count'].'</p>
                    </div>


                          
                    <div class="col-md-1 weight-cart pt-10" style="padding-right:10px">
                        <h5 style="padding-right:10px;margin-bottom:12px;">
                        Remove
                        </h5>
                       <p class="pt-10">
                       <a href="javascript:void(0)" onclick="removeCartItem('.$id.',0)">
                       <i class="fa fa-trash" aria-hidden="true" style="color:red"></i>
                       </a>
                       </p>
                    </div>
   </div>
  </div>
 </div>';
}
}
 
$DealOutput=''; 
if(session('special_cart')){
   
foreach(session('special_cart') as $id => $Specialdetails){
$SpecialPricetbl=Dealofdayprice_tbl::where('product_id',$id)->get()->toArray();
$dealproductImg=asset('uploads/dealOfDay/'.$Specialdetails['photo']);

                   $DealOutput.='<div class="row cartdiv">
                    <div class="col-md-2 p0">
                       <img src="'.$dealproductImg.'" width="100%" style="height:80px">
                    </div>
                    <div class="col-md-10" >
                          
                      <div class="row" style="border-bottom:1px solid silver;padding-bottom:10px;padding-right:20px">
                    <div class="col-md-2 cart-product pt-10" >
                        <h5>'.$Specialdetails['name'].'</h5>
                        <span>Nett: '.$Specialdetails['quantity'].' '.$Specialdetails['quantity_type'].'</span>
                           <h6 class="famount"><i class="fa fa-inr" aria-hidden="true"></i>'.$Specialdetails['price'].'</h6>
                    </div>  
                    
                    <div class="col-md-2 weight-cart pt-10">
                        <h5>Chopping Instructions</h5>
                      <font style="font-size:12px">N/A</font>
                      </div>
                    <div class="col-md-2 weight-cart pt-10" data-th="Quantity">
                        <h5 style="margin-bottom:18px">Quantity</h5>
                        <select class="form-control specialdropdownQty" onchange="changeSpecialCart('.$id.',this.value)" sproduct-id="'.$id
                        .'">';

                     foreach($SpecialPricetbl as $SpricetblData){
                  $DealOutput.='<option '; 
                  if( ($Specialdetails['quantity_type']==$SpricetblData['quantity_type']) && ($Specialdetails['quantity']==$SpricetblData['quantity'])) { 
                  $DealOutput.=' selected ';
                   }else{ }
                  $DealOutput.='value="'.$SpricetblData['id'].'">';
                  $DealOutput.=$SpricetblData['quantity'].' '.$SpricetblData['quantity_type']; 
                  }
                  $DealOutput.='</select>';
                  $DealOutput.='</div>  
                        <input type="text" name="productPrice" hidden value="'.$Specialdetails['price'].'">
                       
                               <div class="col-md-1 weight-cart pt-10">
                        <h5 style="margin-bottom:12px">Tax(%)</h5>
                       <p class="pt-10"> N/A</p>
                        </div>
                     <div class="col-md-2 quant-cart pt-8">
                        <h5 class="text-left " style="margin-bottom:12px">Add More</h5>
                        <div class="input-group pt-8">
          <span class="input-group-btn">
              <button type="button" class="plus-btn" onclick="decriseSpeProductCount('.$id.')" data-type="minus" data-field="quant[1]">
                  <i class="fa fa-minus" aria-hidden="true"></i>
              </button>
          </span>
          <input type="text" name="quant[1]" readonly style="background-color:#fff;padding:0px" class="form-control input-number " value="'.$Specialdetails['count'].'">
          <span class="input-group-btn">
              <button type="button" onclick="increaseSpeProductCount('.$id.')" class="minus-btn" data-type="plus" data-field="quant[1]">
                <i class="fa fa-plus" aria-hidden="true"></i>
              </button>
          </span>
      </div>
     </div>
                


                              <div class="col-md-2 weight-cart pt-10 text-center">
                              <h5 style="margin-bottom:12px">Amount</h5>
                               <p class="famountprice pt-10"><i class="fa fa-inr" aria-hidden="true"></i>'.$Specialdetails['price']*$Specialdetails['count'].'</p>
                               
                             </div> 
                      
                    
                    <div class="col-md-1 weight-cart pt-10" style="padding-right:10px">
                        <h5 style="padding-right:10px;margin-bottom:12px">
                
                        Remove</h5>
                       <p class="pt-10">
    <a href="javascript:void(0)" onclick="removeCartItem('.$id.',1)">
    <i class="fa fa-trash" aria-hidden="true" style="color:red"></i>
    </a>
                       </p>
                    </div>
   </div>
  </div>
 </div>'; 
}
}
$result[0]=$output;
$result[1]=$DealOutput;
return $result;
}

 public function cartBill(){
// print_r(session('special_cart'));
// die;


 $tax=0;
if(session('special_cart')){
   
foreach(session('special_cart') as $id => $Specialdetails){
$SpecialPricetbl=Dealofdayprice_tbl::where('product_id',$id)->get()->toArray();
$total += $Specialdetails['price']*$Specialdetails['count'];
// $tax+=$Specialdetails['tax'];
}
}
$taxAmt=0;
 if(session('cart')){
     foreach(session('cart') as $id => $details){
 
$pricetbl=Product_price_tbl::where('product_id',$id)->get()->toArray();

     $total += $details['price']*$details['count'];
    

/* ---------- tax -----------*/
if($details['tax']>0){
   $tax+=$details['tax'];
  $taxAplicableAMT=$details['price']*$details['count'];
  $taxAmt+=($taxAplicableAMT/100)*$details['tax'];
}
/*----------- tax ---------*/
}
}
/*--------- add tax --------*/

/*-------- express delivery ----*/

if(session()->get('checkExpressDelivery')=="1"){
if(session()->get('city')){
$cityData=Available_city::find(session()->get('city'));
$cityCate=$cityData->category;
}else{
$cityData=Available_city::find('1');
$cityCate=$cityData->category;
}

$cityCate=MinOrderAmount::where('category',$cityCate)->get()->toArray();

$rupExpDelCharge=$cityCate[0]['expressDelAmount'];

}else{
$rupExpDelCharge=0;
}

/*-------- end express delivery ----*/

  // $ActTotalAmt=$taxAmt+$total;
/*--------- end add tax --------*/

/* -------  Discount -----------*/


$amtDesOne=Discount::where('id','1')->where('status','1')->get()->toArray();
 $firstdiccountLimit=$amtDesOne[0];
$amtDesTwo=Discount::where('id','2')->where('status','2')->get()->toArray();
 $seconddiccountLimit=$amtDesTwo[0];

if($seconddiccountLimit['id'] && (ceil($total)>$seconddiccountLimit['amount'])){
if(ceil($total)>$seconddiccountLimit['amount']){

$offprice=($total/100)*$seconddiccountLimit['discount'];

if($seconddiccountLimit['pack_of_surprise']){
    
$sepoffprice=($total/100)*$seconddiccountLimit['pack_of_surprise'];

}
}
}elseif($firstdiccountLimit['id'] && (ceil($total)>$firstdiccountLimit['amount'])){

$offprice=($total/100)*$firstdiccountLimit['discount'];
$sepoffprice='0';

}else{
  $offprice='0';
$sepoffprice='0';
}




  $nowDateTime = date('Y-m-d h:i:00');
  $happyHours=HappyHoursDicount::whereDate('from_date','<=',$nowDateTime)->whereDate('to_date','>=',$nowDateTime)->where('status','1')->get()->toArray();

 if($happyHours[0]['offer']>0){
 $happyHoursDiscount=($total/100)*$happyHours[0]['offer'];
 }else{
 $happyHoursDiscount='0';
 }
  
  $nowDate = date('Y-m-d');
  $launchDiscount=LaunchingDiscount::whereDate('from_date','<=',$nowDate)->whereDate('to_date','>=',$nowDate)->where('status','1')->get()->toArray();
  if($launchDiscount[0]['offer']>0){
  $launchDiscount=($total/100)*$launchDiscount[0]['offer'];
  }else{
  $launchDiscount='0';
  }

/*-- general Coupon --*/
if(session()->get('generalCouponId')){
  $couponId=session()->get('generalCouponId');
  $couponCodeID=Coupon::find($couponId);
  $couponOff=$couponCodeID->off_price;
  }else{
  $couponOff=0;
  }

  $totaloff=$happyHoursDiscount+$sepoffprice+$offprice+$launchDiscount+$couponOff;

/*----------- Discount -----------*/


/*--- get total Amount ----*/

 $totalPAyAmt= ($total+$taxAmt+$rupExpDelCharge)-$totaloff;

/*----- get total amount --*/

    if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }
     $cityDetails=DB::table('available_cities')
     ->select('available_cities.name','available_cities.id','min_order_amounts.amount','min_order_amounts.category')
     ->join('min_order_amounts','available_cities.category','=','min_order_amounts.category')
     ->where('available_cities.id',$selectCity)
     ->get();
     $cityMinDelivPrice=$cityDetails[0]->amount;

     $withoutDecimalCityMinDelivPrice=ceil($cityMinDelivPrice);
     $withoutDecimalTotalPAyAmt=ceil($totalPAyAmt);

            $removeCart=url('removeCart');
            $output='';
            $output.='
                     <div class="col-md-6">
                       <p>Sub total  </p>
                     </div>
                     <div class="col-md-6"> 
                       <p style="text-align:right"><i class="fa fa-inr" aria-hidden="true"></i>'.$total.'</p>
                       </div> 

                    <div class="col-md-6">
                       <p>Tax  </p>
                     </div>
                     <div class="col-md-6"> 
                       <p style="text-align:right">
                       <i class="fa fa-inr" aria-hidden="true"></i>
                       '.$taxAmt.'</p>
                   </div>

                   <div class="col-md-6">
                       <p>Discount </p>
                     </div>
                     <div class="col-md-6"> 
                       <p style="text-align:right">
                       <i class="fa fa-inr" aria-hidden="true"></i>
                       '.ceil($totaloff).'</p>
                   </div>
                   <div class="col-md-7">
                       <p>Delivery Charges </p>
                     </div>
                     <div class="col-md-5"> 
                       <p style="text-align:right"> Free</p>
                   </div>

                    <div class="col-md-6">
                       <p>Grand Total </p>
                     </div>
                     <div class="col-md-6"> 
                       <p style="text-align:right"> <i class="fa fa-inr" aria-hidden="true"></i>'.ceil($totalPAyAmt).'</p>
                   </div>
                   <div class="col-md-12">
                    <a href="javascript:void(0)" onclick="minDeliverPriced('.$withoutDecimalCityMinDelivPrice.','.$withoutDecimalTotalPAyAmt.')">Place Order</a>
                   </div>
                    <div class="col-md-4">
                    <i style="font-size:14px"></i>
                   </div>
                   <div class="col-md-8">
                    <i class="fa fa-trase"><a style="background-color:#fff;color:#2b2f7f" href="'.$removeCart.'">EMPTY YOUR CART</a></i>
                   </div>
                    ';
                   return $output;
 }


public function getFinalPageCartDetails(){


$result=array();
$output='';

// print_r(session('cart'));
// die;
 if(session('cart')){
 foreach(session('cart') as $id => $details){


 $pricetbl=Product_price_tbl::where('product_id',$id)->get()->toArray();

 $total += $details['price']*$details['count'];

 $porductImg=asset('uploads/foodService/'.$details['photo']);
 $removeDeal=0;
      $output.='
                <div class="row text-left m0" style="background:#f5f5f5;padding:5px 10px;margin-top:20px;">
                               <div class="col-md-3 p0">
                                 <img src="'.$porductImg.'" width="100%">
                          </div>  
                           <div class="col-md-7 p0" style="padding-left:3px;">
                                <h4>'.$details['name'].'</h4>
                                <p class="time">Nett '.$details['quantity'].' '.$details['quantity_type'].'<span style="float:right">
                                '.$details['cuttingInst'].'</span></p>
                              <p class="time">Qty:'.$details['count'].'</p>
                          </div> 
                          <div class="col-md-2 text-right p0 pricingcol">
                             <h4><i class="fa fa-inr" aria-hidden="true"></i>'.ceil($details['price']).'</h4>
                               <p class="time" style="visibility:hidden;margin-bottom:0px;">Nett '.$details['quantity'].' '.$details['quantity_type'].' </p>
                             
                          </div> 
                         </div>
               ';
             }
           }

$DealOutput=''; 
if(session('special_cart')){
   
foreach(session('special_cart') as $id => $Specialdetails){
$SpecialPricetbl=Dealofdayprice_tbl::where('product_id',$id)->get()->toArray();
$dealproductImg=asset('uploads/dealOfDay/'.$Specialdetails['photo']);
$removeDeal=1;
$DealOutput.='
     <div class="row text-left m0" style="background:#f5f5f5;padding:5px 10px;margin-top:20px;">
                               <div class="col-md-3 p0">
                                 <img src="'.$dealproductImg.'" width="100%">
                          </div>  
                           <div class="col-md-7 p0" style="padding-left:3px;">
                                <h4>'.$Specialdetails['name'].'</h4>
                                <p class="time">Nett '.$Specialdetails['quantity'].' '.$Specialdetails['quantity_type'].'<span style="float:right">
                                '.$Specialdetails['cuttingInst'].'</span></p>
                              <p class="time">Qty:'.$Specialdetails['count'].'</p>
                          </div> 
                          <div class="col-md-2 text-right p0 pricingcol">
                             <h4><i class="fa fa-inr" aria-hidden="true"></i>'.ceil($Specialdetails['price']).'</h4>
                               <p class="time" style="visibility:hidden;margin-bottom:0px;">Nett '.$Specialdetails['quantity'].' '.$Specialdetails['quantity_type'].' </p>
                             
                          </div> 
                         </div>
             ';

}
}
               
$result[0]=$output;
$result[1]= $DealOutput;
return $result;
     }


public function getFinalPageBillDetails(){

$tax=0;
$total=0;
$taxAmt=0;
$output='';

if(session('special_cart')){
   
foreach(session('special_cart') as $id => $Specialdetails){
$SpecialPricetbl=Dealofdayprice_tbl::where('product_id',$id)->get()->toArray();
$total += $Specialdetails['price']*$Specialdetails['count'];
// $tax+=$Specialdetails['tax'];
}
}

 $taxAmt=0;
 if(session('cart')){

 foreach(session('cart') as $id => $details){
 
$pricetbl=Product_price_tbl::where('product_id',$id)->get()->toArray();

$total += $details['price']*$details['count'];

 /* ---------- tax -----------*/
 $tax+=$details['tax'];
 $taxAmt+=$details['tax']*($details['price']*$details['count']/100);

/*----------- tax ---------*/

}
}
// echo $tax;

     $output.='<div class="col-md-8">
                       <p>Sub Total:  </p>
                     </div>
                     <div class="col-md-4"> 
                       <p style="text-align:right"><i class="fa fa-inr" aria-hidden="true"></i>'.$total.'</p>
                   </div>'; 

/* ---------- tax -----------*/
   $output.='<div class="col-md-4">
                       <p>Tax </p>
                      </div>
                      <div class="col-md-4"> 
                     </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                        <i class="fa fa-inr" aria-hidden="true"></i>'.$taxAmt.'     
                       </p>
                     </div>';

/*----------- tax ---------*/

/*-------- express delivery ----*/

if(session()->get('checkExpressDelivery')=="1"){
if(session()->get('city')){
$cityData=Available_city::find(session()->get('city'));
$cityCate=$cityData->category;
}else{
$cityData=Available_city::find('1');
$cityCate=$cityData->category;
}

$cityCate=MinOrderAmount::where('category',$cityCate)->get()->toArray();

$rupExpDelCharge=$cityCate[0]['expressDelAmount'];

   $output.='<div class="col-md-4">
                       <p>Exp Delivery</p>
                      </div>
                      <div class="col-md-4"> 
                      </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                        <i class="fa fa-inr" aria-hidden="true"></i>'.$rupExpDelCharge.'     
                       </p>
                     </div>';

}else{
$rupExpDelCharge=0;
}

/*-------- end express delivery ----*/


/* -------  Discount -----------*/

           $output.='<div class="col-md-8">
                       <p>Discount </p>
                     </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                          
                       </p>
                     </div>';

$amtDesOne=Discount::where('id','1')->where('status','1')->get();
$amtDesTwo=Discount::where('id','2')->where('status','1')->get();

 $firstdiccountLimit=$amtDesOne[0];
 $seconddiccountLimit=$amtDesTwo[0];
//  echo"<pre>";
// print_r($firstdiccountLimit);
// die;
if($seconddiccountLimit->id){


if(ceil($total)>$seconddiccountLimit->amount){
$offprice=($total/100)*$seconddiccountLimit->discount;

                  $output.='<div class="col-md-4">
                       <p>Up To <i class="fa fa-inr" aria-hidden="true"></i>'.$seconddiccountLimit->amount.' </p>
                      </div>
                      <div class="col-md-4"> <p> '.$seconddiccountLimit->discount.' % </p>  
                     </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                        <i class="fa fa-inr" aria-hidden="true"></i>'.$offprice.'     
                       </p>
                     </div>';

if($seconddiccountLimit->pack_of_surprise){
    
$sepoffprice=($total/100)*$seconddiccountLimit->pack_of_surprise;

                   $output.='<div class="col-md-4">
                       <p>Up To <i class="fa fa-inr" aria-hidden="true"></i>'.$seconddiccountLimit->amount.' Surprise</p>
                      </div>
                      <div class="col-md-4"> <p> '.$seconddiccountLimit->pack_of_surprise.' % </p>  
                     </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                        <i class="fa fa-inr" aria-hidden="true"></i>'.$sepoffprice.'     
                       </p>
                     </div>';

}
}else{
$sepoffprice='0';
}
}else{
$sepoffprice='0';
}


if($firstdiccountLimit->id){
if(ceil($total)>$firstdiccountLimit->amount){

$offprice=($total/100)*$firstdiccountLimit->discount;

                    $output.='<div class="col-md-4">
                       <p>Up To <i class="fa fa-inr" aria-hidden="true"></i>'.$firstdiccountLimit->amount.'</p>
                      </div>
                      <div class="col-md-4"> <p> '.$firstdiccountLimit->discount.' % </p>  
                     </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                        <i class="fa fa-inr" aria-hidden="true"></i>'.$offprice.'     
                       </p>
                     </div>';
}else{
$offprice='0';
}
}else{
$offprice='0';
}

  $nowDateTime = date('Y-m-d h:i:00');
  $happyHours=HappyHoursDicount::whereDate('from_date','<=',$nowDateTime)->whereDate('to_date','>=',$nowDateTime)->where('status','1')->get()->toArray();

 if($happyHours[0]['id']){

 if($happyHours[0]['offer']>0){
 $happyHoursDiscount=($total/100)*$happyHours[0]['offer'];

 $output.='<div class="col-md-4">
                       <p>Happy Hours</p>
                      </div>
                      <div class="col-md-4"> <p> '.$happyHours[0]['offer'].' % </p>  
                     </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                        <i class="fa fa-inr" aria-hidden="true"></i>'.$happyHoursDiscount.'     
                       </p>
                     </div>';
 }else{
 $happyHoursDiscount='0';
 }
 }else{
 $happyHoursDiscount='0';
 }

  
  $nowDate = date('Y-m-d');
  $launchDiscount=LaunchingDiscount::whereDate('from_date','<=',$nowDate)->whereDate('to_date','>=',$nowDate)->where('status','1')->get()->toArray();
  //  echo"<pre>";
  // print_r($launchDiscount);
   
  if($launchDiscount[0]['id']){
 if($launchDiscount[0]['offer']>0){
  $launchoff=$launchDiscount[0]['offer'];
  $launchDiscount=($total/100)*$launchDiscount[0]['offer'];

   $output.='<div class="col-md-4">
                       <p>Launching</p>
                      </div>
                      <div class="col-md-4"><p>'.$launchoff.' % </p>  
                     </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                        <i class="fa fa-inr" aria-hidden="true"></i>'.$launchDiscount.'     
                       </p>
              </div>';
  }else{
  $launchDiscount='0';
  }
  }else{
 $launchDiscount='0';
  }
 
  $nowDate = date('Y-m-d');
  $chkSignUpDiscount=SignupDicount::whereDate('from_date','<=',$nowDate)->whereDate('to_date','>=',$nowDate)->where('status','1')->get()->toArray();

if($chkSignUpDiscount[0]['id']){

if($chkSignUpDiscount[0]['offer']>0){

   $chkNewUser=User::where('email',session()->get('loginEmail'))->get()->toArray();
   $chkNewUserId=$chkNewUser[0]['id'];
   $chkUserBokId=Booking::where('user_id',$chkNewUserId)->get()->toArray();
   if($chkUserBokId['id']){


}else{
    
          $newSignUpoffPre=$chkSignUpDiscount[0]['offer'];
      $newSignUpoffPrice=($total/100)*$chkSignUpDiscount[0]['offer'];

                    $output.='<div class="col-md-4">
                       <p>New User</p>
                      </div>
                      <div class="col-md-4"> <p> '.$newSignUpoffPre.' % </p>  
                     </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                        <i class="fa fa-inr" aria-hidden="true"></i>'.$newSignUpoffPrice.'     
                       </p>
                     </div>';
    
}
   }else{
   $newSignUpoffPrice='0';
   }
}else{
  $newSignUpoffPrice='0';
}

   if(session()->get('coupon')){
   
   $chkNewUser=User::where('email',session()->get('loginEmail'))->get()->toArray();
   $chkNewUserId=$chkNewUser[0]['id'];

   // $promocode=UsedPromoCode::where('user_id',$chkNewUserId)->get()->toArray();
   // $promocodeId=$promocode[0]['coupon_id'];


   $procodeDetails=Coupon::where('user_id',$chkNewUserId)->where('status','1')->get()->toArray();
   $couponOff=$procodeDetails[0]['off_price'];

if($procodeDetails[0]['id']){

   if($couponOff>0){

   $couponOffPrice=$couponOff;

        $output.='<div class="col-md-4">
                       <p>Refund Coupon</p>
                      </div>
                      <div class="col-md-4">
                     </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                        <i class="fa fa-inr" aria-hidden="true"></i>'.$couponOffPrice.'     
                       </p>
              </div>';
   }else{
   $couponOffPrice='0';

   }
   }else{
   $couponOffPrice='0';
   }
   }else{
   $couponOffPrice='0';
   }

// echo session()->get('generalCouponId');
if(session()->get('generalCouponId')){
$generalCoupon=Coupon::where(['status'=>'1','id'=>session()->get('generalCouponId')])->get()->toArray();
// echo"<pre>";
// print_r($generalCoupon);

if($generalCoupon[0]['id']){
$generalPromOff=$generalCoupon[0]['off_price'];
        $output.='<div class="col-md-4">
                       <p>Coupon Code</p>
                      </div>
                      <div class="col-md-4">
                     </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                        <i class="fa fa-inr" aria-hidden="true"></i>'.$generalPromOff.'     
                       </p>
              </div>';
}else{
$generalPromOff='0';
}
}else{
  if(session()->get('alreadyUsedPromoCode')){

$output.='<div class="col-md-4">
                       <p>Coupon Code</p>
                      </div>
                      <div class="col-md-4">
                     </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                        '.session()->get('alreadyUsedPromoCode').'     
                       </p>
              </div>';
  }else{

  }
   $generalPromOff='0';
  }


 $totaloff=$happyHoursDiscount+$sepoffprice+$offprice+$launchDiscount+$newSignUpoffPrice+$couponOffPrice+$generalPromOff;

   session()->put('offAmount',$totaloff);
   session()->get('offAmount');
   
   $output.='<div class="col-md-4">
                       <p>Total Saving</p>
                      </div>
                      <div class="col-md-4">  
                     </div>
                     <div class="col-md-4"> 
                        <p style="text-align:right">
                        <i class="fa fa-inr" aria-hidden="true"></i>'.$totaloff.'     
                       </p>
              </div>';
/*----------- Discount -----------*/

/*--- get total Amount ----*/
 session()->forget('tatalPayAMT');
 $totalPAyAmt= ($total+$taxAmt+$rupExpDelCharge)-$totaloff;
 session()->put('tatalPayAMT',$totalPAyAmt);  
//  echo session()->get('tatalPayAMT');
/*----- get total amount --*/
          
                $output.='<div class="col-md-7">
                       <p>Delivery Charges </p>
                     </div>
                     <div class="col-md-5"> 
                       <p style="text-align:right"> Free</p>
                   </div>

                    <div class="col-md-6 totalprice">
                       <p>Total Price </p>
                     </div>
                     <div class="col-md-6 totalprice"> 
                       <p style="text-align:right" class="totprice"> <i class="fa fa-inr" aria-hidden="true"></i>'.ceil($totalPAyAmt).'</p>
                     </div>';
                $output.='<input type="textbox" name="totalPayAmt" id="totalPayAmt" hidden value="'.ceil($totalPAyAmt).'">';
        return $output; 
     }

     public function removeCartItem(Request $req){
       if($req->type==0){
        $id=$req->id;
        $cart=session()->get('cart');
             unset($cart[$id]);
             session()->put('cart', $cart);
         }else{
        $id=$req->id;
        $cart=session()->get('special_cart');
             unset($cart[$id]);
             session()->put('special_cart', $cart);
         }
       }

        public function removeCart(){
        session()->forget('cart');
        session()->forget('special_cart'); 
         return redirect('/'); 
        }

   public function applyNormalCoupon(Request $req){
   
   $dbCoupon=Coupon::where('name',$req->code)->get()->toArray();
   if($dbCoupon[0]['id']){
    $status=1;
    session()->put('generalCouponId',$dbCoupon[0]['id']);
    return $status; 
    }else{
    $status=0;
    return $status;   
    }
    }

   public function applyCouponCode(Request $req){
   $result='';
   $chkNewUser=User::where('email',session()->get('loginEmail'))->get()->toArray();
   $chkNewUserId=$chkNewUser[0]['id'];

       $usercode=$req->code;
       $dbCoupon=Coupon::where('name',$usercode)->get()->toArray();
       if($dbCoupon[0]['id']){
       
       $chkUsedCouponId=UsedPromoCode::where(['user_id'=>$chkNewUserId,'coupon_id'=>$dbCoupon[0]['id']])->get()->toArray();

    // $chkUsedCouponId=UsedPromoCode::where(['user_id'=>$chkNewUserId])->get()->toArray();

        if($chkUsedCouponId[0]['id']){
    $result.='<p>You Are Already Used Coupon Code</p>';
        }else{
    session()->put('coupon','1');  

    $dbPromoCode=new UsedPromoCode;
    $dbPromoCode->coupon_id=$dbCoupon[0]['id'];
    $dbPromoCode->user_id=$chkNewUserId;
    $dbPromoCode->save();
    
    $couponId=Coupon::find($dbCoupon[0]['id']);
    $couponId->used_coupon_status='0';
    $couponId->update();

    $result.='<p>Coupon Code Apply Successfully..</p>';
        }
        }else{
    $result.='<p>Please Enter Valide Coupon Code</p>';
        }
     return $result;   
   }


    public function getUserInstruction(Request $req){
    $userReq=$req->userReq;
    session()->put('bokInfo',$userReq);
    }

    public function checkExpressDelivery(Request $req){
    session()->put('checkExpressDelivery',$req->status);

    //return $req->input();
    }

   function getTransationId(Request $req){
     session()->forget('trId');
     session()->put('trId',$req->trId);
   }

    public function rating(){
 
    $orderId=session()->get('orderIdValue');
    $totalPay=ceil(session()->get('tatalPayAMT'));
    $paymenttbl=new Payment_tbl;
    $paymenttbl->order_id=$orderId;
    $paymenttbl->total_amount=$totalPay;
    $paymenttbl->total_off=session()->get('offAmount');
    $paymenttbl->transation_id=session()->get('trId');
    $paymenttbl->save();
// echo"<pre>";
foreach(session()->get('cart') as $cart){
// print_r($cart);
$outgoingProduct=new Outgoing_product;
$outgoingProduct->product_id=$cart['productId'];
$outgoingProduct->order_id=$orderId;
$outgoingProduct->product_price_id=$cart['price_tbl_id'];
$outgoingProduct->productType=$cart['productType'];
$outgoingProduct->qty=$cart['count'];
$outgoingProduct->tax=$cart['tax'];
$outgoingProduct->save();

$qty=$cart['quantity']*$cart['count'];
if($cart['quantity_type']=="kilo-gram"){
$subtractQty=$qty*1000;
}else{
$subtractQty=$qty;
}
$availableStock=FoodService::find($cart['productId']);
$newAvailableStock=$availableStock->stock-$subtractQty;
$availableStock->stock=$newAvailableStock;
$availableStock->update();

}

foreach(session()->get('special_cart') as $special_cart){
$outgoingProduct=new Outgoing_product;
$outgoingProduct->product_id=$special_cart['productId'];
$outgoingProduct->order_id=$orderId;
$outgoingProduct->product_price_id=$special_cart['price_tbl_id'];
$outgoingProduct->productType=$special_cart['productType'];
$outgoingProduct->qty=$special_cart['count'];
$outgoingProduct->tax=0;
$outgoingProduct->save();
$sepqty=$special_cart['quantity']*$special_cart['count'];
if($special_cart['quantity_type']=="kilo-gram"){
$speSubtractQty=$sepqty*1000;
}else{
$speSubtractQty=$sepqty;
}
  $speCartStock=Deal_of_day::find($special_cart['productId']);
  $speAveliableStock=$speCartStock->stock;
  $newSpeAveliableStock=$speAveliableStock-$speSubtractQty;
  $speCartStock->stock=$newSpeAveliableStock;
  $speCartStock->update();
}

session()->forget('trId');
session()->forget('alreadyUsedPromoCode');
session()->forget('otp_email');
session()->forget('orderIdValue');
session()->forget('coupon');
session()->forget('special_cart');
session()->forget('totalProductAmount');
session()->forget('cart');
session()->forget('orderDate');
session()->forget('orderTime');
session()->forget('signup_otp_email');
session()->forget('totaloff');
session()->forget('bokInfo');
session()->forget('deliveryTime');
session()->forget('bookingDate');
return view('website.thanks'); 
    }

}
