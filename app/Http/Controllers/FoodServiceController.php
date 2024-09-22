<?php
namespace App\Http\Controllers;
error_reporting(1);
use App\FoodService;
use App\FoodCategory;
use App\Dealofdayprice_tbl;
use App\CoBrond;
use App\Deal_of_day;
use App\Product_price_tbl;
use Illuminate\Http\Request;
use Session;
use App\Available_city;
use App\Product_city;
use App\CuttingInstruction;
use DB;

class FoodServiceController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $FoodService=FoodService::orderBy('id','desc')->get();
       
        return view('admin.foodServices.index',['service'=>$FoodService]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $ebcCategory=FoodCategory::where('category_type','ebc')->orderBy('id','desc')->get();
       
     $serviceCategory=FoodCategory::where('status','1')->get();  
     $availaleCity=Available_city::all(); 
     return view('admin.foodServices.view',['serviceCategory'=>$serviceCategory,'availaleCity'=>$availaleCity,'ebcCategory'=>$ebcCategory]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   // return $request->input();
       $request->validate([
           "foodCategory" => 'required',
           "service_name"=>'required',
           "service_short_description"=>'required|min:30',       
           'service_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'foodCity'=>'required',
           "price"=>'array|digits_between:1,5',
           "piece"=>'array|digits_between:1,5',
           "weight"=>'array|digits_between:1,5',
           "plate"=>'array|digits_between:1,5',
                     ]); 
        $sreq = new FoodService;
        $sreq->service_cate_id=$request->foodCategory;
        $sreq->service_name=$request->service_name; 
        $sreq->service_short_des=$request->service_short_description; 
        $sreq->service_offer=$request->offer;
        $sreq->tax=$request->tax;
        $sreq->ebc_id=$request->ebc_category;
 
        $sreq->stock_qty_type=$request->stoctQtyType;
        if($request->qtytype=='weigth'){
        $sreq->stock=$request->qtyStorage*1000;
        }else{
        $sreq->stock=$request->qtyStorage;
        }

        $sreq->side_addons=$request->side_addons;   
        $sreq->product_type=$request->productType;
        $sreq->cutting_instruction=implode(',',$request->cutting);
        $imageName = time().'.'.$request->service_img->extension();  
        $sreq->service_img=$imageName;
        $request->service_img->move(public_path('uploads/foodService'), $imageName);
        $sreq->save();
        $productId=$sreq->id;  
        for($j=0;$j<count($request->foodCity);$j++){
            $proCity = new Product_city;
            $proCity->city_id=$request->foodCity[$j];
            $proCity->product_id=$productId;          
             $proCity->save();
        }
if($request->qtytype=='weigth'){

for($k=0;$k<count($request->price);$k++){
$productPrice=new product_price_tbl;
$productPrice->quantity=$request->weight[$k];
$productPrice->quantity_type=$request->meagurementType[$k];
$productPrice->price=$request->price[$k];
$productPrice->type=$request->qtytype;
$productPrice->product_id=$productId;
$productPrice->save();

}
}elseif($request->qtytype=='piece'){

for($l=0;$l<count($request->price);$l++){
    $productPrice=new product_price_tbl;
$productPrice->quantity=$request->piece[$l];
$productPrice->quantity_type='piece';
$productPrice->price=$request->price[$l];
$productPrice->type=$request->qtytype;
$productPrice->product_id=$productId;
$productPrice->save();
}
}elseif($request->qtytype=='plate'){

for($m=0;$m<count($request->price);$m++){
    $productPrice=new product_price_tbl;
$productPrice->quantity=$request->plate[$m];
$productPrice->quantity_type='plate';
$productPrice->price=$request->price[$m];
$productPrice->type=$request->qtytype;
$productPrice->product_id=$productId;
$productPrice->save();
}
}else{
}
        \Session::put('success','Data Add Successfully.');
        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $availableCityData=array();
      $productDetails=array();
      $cut=array();
      $serviceData=FoodService::where('id',$id)->get()->toArray();  
      $productDetails[]=$serviceData;  
      $pricetbl=Product_price_tbl::where('product_id',$serviceData[0]['id'])->get()->toArray();
  foreach($pricetbl as $key => $pricetblvalue) {
      $productDetails[0]['price'][]=$pricetblvalue;
       }

   $productCity=Product_city::where('product_id',$id)->get();
    foreach ($productCity as $key => $productCityval){
   $availableCity=Available_city::where('id',$productCityval->city_id)->get();
   $availableCityData[]=$availableCity[0]->name;
       }

   if($serviceData[0]['service_cate_id']){
   $productCate=FoodCategory::where('id',$serviceData[0]['service_cate_id'])->get();
   $productCategory=$productCate[0]->category_name;
   }

  if($serviceData[0]['ebc_id']){
   $productEBC=FoodCategory::where('id',$serviceData[0]['ebc_id'])->get();
   $exploreBy=$productEBC[0]->category_name;
   }

  $cutInst=explode(',',$serviceData[0]['cutting_instruction']);

  for($i=0;$i<count($cutInst);$i++){
    $cutRawdata=CuttingInstruction::where('id',$cutInst[$i])->get();
  $cut[]=$cutRawdata[0]->name;
  }

  return view('admin.foodServices.detail',['ServDetails'=>$productDetails,'availableCityData'=>$availableCityData,'productCategory'=>$productCategory,'exploreBy'=>$exploreBy,'cut'=>$cut]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$type='')
    {
      if($type=='piece'){
      $priceType='piece';
      }elseif($type=='weigth'){
      $priceType='weigth';
      }elseif($type=='plate'){
      $priceType='plate';
      }else{
      $priceType=''; 
      }
     $arrayEditval=array();
     $serviceCategory=FoodCategory::all(); 
     $editData=FoodService::where('id',$id)->get()->toArray();
     $arrayEditval[]=$editData;
     $cityData=Product_city::where('product_id',$editData[0]['id'])->get()->toArray();    
     foreach($cityData as $key1=>$cityDataval){
      $arrayEditval['cityId'][$key1]=$cityDataval['city_id'];
     }
      $ebcCategory=FoodCategory::where('category_type','ebc')->orderBy('id','desc')->get();
     

     $productPrice= DB::table('food_services')
            ->select('product_price_tbls.id','product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type')
            ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')->where('food_services.id',$id)
            ->get()
            ->toArray();

      $dbPriceType=$productPrice[0]->type;
      $availaleCity= Available_city::all(); 
      return view('admin.foodServices.edit',['editData'=>$arrayEditval,'serviceCategory'=>$serviceCategory,'availaleCity'=>$availaleCity,'productPrice'=>$productPrice,'priceType'=>$priceType,'dbPriceType'=>$dbPriceType,'ebcCategory'=>$ebcCategory]);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//qtytype
      //return $request->input();

           $request->validate([
           "foodCategory" => 'required',
           "service_name"=>'required',
           "service_short_description"=>'required|min:30',
        
           'foodCity'=>'required',
                     ]); 
        $sreq=FoodService::find($request->input('editId'));
        $sreq->service_cate_id=$request->foodCategory;
        $sreq->service_name=$request->service_name; 
        $sreq->service_short_des=$request->service_short_description; 
        // $sreq->no_of_pices=$request->no_of_pices; 
        // $sreq->service_price=$request->price; 
        $sreq->stock_qty_type=$request->stoctQtyType;
        $sreq->ebc_id=$request->ebc_category;
        if($request->qtytype=='weigth'){
        $sreq->stock=$request->qtyStorage*1000;
        }else{
        $sreq->stock=$request->qtyStorage;
        }
    
        $sreq->service_offer=$request->offer;  
        $sreq->tax=$request->tax;
        $sreq->side_addons=$request->side_addons;   
        $sreq->product_type=$request->productType;    
        // $sreq->actualWeight=$request->actualWeight; 
        // $sreq->homePageStatus=$request->chktopbar;
       $sreq->cutting_instruction=implode(',',$request->cutting);

     if($request->file('service_img')){
       $request->validate([
       'service_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]); 
       
        $imageName = time().'.'.$request->service_img->extension();  
        $sreq->service_img=$imageName;
        $request->service_img->move(public_path('uploads/foodService'), $imageName);
     }else{
     $sreq->service_img=$request->input('oldImg');
     }
     $sreq->update();

     $editProductCity=Product_city::where('product_id',$request->input('editId'))->get()->toArray();

     if($editProductCity){
      $productIdval=$editProductCity[0]['product_id'];
      Product_city::where('product_id',$productIdval)->delete();

           for($j=0;$j<count($request->foodCity);$j++){
            $proCity = new Product_city;
            $proCity->city_id=$request->foodCity[$j];
            $proCity->product_id=$request->input('editId');          
             $proCity->save();
      }
      }else{      
           for($j=0;$j<count($request->foodCity);$j++){
            $proCity = new Product_city;
            $proCity->city_id=$request->foodCity[$j];
            $proCity->product_id=$request->input('editId');          
             $proCity->save();
        }
        }
     $productId=$request->input('editId');
     product_price_tbl::where('product_id',$productId)->delete();

if($request->qtytype=='weigth'){

for($k=0;$k<count($request->price);$k++){
$productPrice=new product_price_tbl;
$productPrice->quantity=$request->weight[$k];
$productPrice->quantity_type=$request->meagurementType[$k];
$productPrice->price=$request->price[$k];
$productPrice->type=$request->qtytype;
$productPrice->product_id=$productId;
$productPrice->save();

}
}elseif($request->qtytype=='piece'){

for($l=0;$l<count($request->price);$l++){
    $productPrice=new product_price_tbl;
$productPrice->quantity=$request->piece[$l];
$productPrice->quantity_type='piece';
$productPrice->price=$request->price[$l];
$productPrice->type=$request->qtytype;
$productPrice->product_id=$productId;
$productPrice->save();
}
}elseif($request->qtytype=='plate'){

for($m=0;$m<count($request->price);$m++){
$productPrice=new product_price_tbl;
$productPrice->quantity=$request->plate[$m];
$productPrice->quantity_type='plate';
$productPrice->price=$request->price[$m];
$productPrice->type=$request->qtytype;
$productPrice->product_id=$productId;
$productPrice->save();
}
}else{
}
     \Session::put('success','Data Update Successfully.');
     return redirect('/product');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      FoodService::find($id)->delete();
     \Session::put('warning','Data Remove Successfully.');
       return redirect('/product'); 
    }
/*----- updateCategoryStatus ----*/
    public function updateCategoryStatus(Request $request){
            $uDocData=FoodService::find($request->input('id'));
            $uDocData->status=$request->servStatus;
            $uDocData->update();
    }

   public function chkHomeServSecShowStatus(Request $request){
    $count=FoodService::where('homePageStatus','on')->get()->count();
    if($count>11){
    $retdataSec=array('high');
    }else{
    $retdataSec=array('low');
    }
    return json_encode($retdataSec);  
    }

   public function productDetail($id,$type=''){
   if($type){
              if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }

            $cateId=FoodService::find($id)->service_cate_id;

            if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }
              $foodData=DB::table('product_cities')
            
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('co_bronds','food_services.service_cate_id','=','co_bronds.id')
                ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')
                ->where(['product_cities.city_id'=>$selectCity,'food_services.id'=>$id])
                ->select('product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','co_bronds.name','food_services.service_short_des','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
                  ->groupBY('product_price_tbls.product_id')
                  ->get();

                $foodPriceQty=$foodData[0]->id;
                $priceQty=Product_price_tbl::where('product_id',$foodPriceQty)->get()->toArray();
       
              $allProductItem=DB::table('product_cities')
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('co_bronds','food_services.service_cate_id','=','co_bronds.id')
                ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')
               ->where(['product_cities.city_id'=>$selectCity,'food_services.service_cate_id'=>$cateId])
               ->select('product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','co_bronds.name','food_services.service_short_des','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
                ->groupBY('product_price_tbls.product_id')    
                ->get();
                $cobrand="1";
   return view('website.product',['productItem'=>$foodData[0],'priceQty'=>$priceQty,'arrayDealOfDayData'=>$allProductItem,'cobrand'=>$cobrand]); 

}else{
if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }

            $cateId=FoodService::find($id)->service_cate_id;

            if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }
              $foodData=DB::table('product_cities')
            
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('food_categories','food_services.service_cate_id','=','food_categories.id')
                ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')
                ->where(['product_cities.city_id'=>$selectCity,'food_services.id'=>$id])
                ->select('product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_categories.category_name','food_services.service_short_des','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
                  ->groupBY('product_price_tbls.product_id')
                  ->get();
        
                $foodPriceQty=$foodData[0]->id;
                $priceQty=Product_price_tbl::where('product_id',$foodPriceQty)->get()->toArray();
       
              $allProductItem=DB::table('product_cities')
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('food_categories','food_services.service_cate_id','=','food_categories.id')
                ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')
               ->where(['product_cities.city_id'=>$selectCity,'food_services.service_cate_id'=>$cateId])
               ->select('product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_categories.category_name','food_services.service_short_des','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
                ->groupBY('product_price_tbls.product_id')    
                ->get();
                $cobrand="0"; 
   return view('website.product',['productItem'=>$foodData[0],'priceQty'=>$priceQty,'arrayDealOfDayData'=>$allProductItem,'cobrand'=>$cobrand]); 
  }
  }
 
   public function removeProductPriceItem(Request $request){
          product_price_tbl::find($request->id)->delete();
     }

   public function getProductCateType(Request $request){
   $output='';
   $output.='<select name="foodCategory" class="form-control" required="">
             <option value="">-- Select Product Category --</option>'; 
                   
 if($request->productType=='0'){
           $cate=FoodCategory::all();
     foreach ($cate as $catevalue) {

$output.='<option value="'.$catevalue->id.'">'.$catevalue->category_name.'</option>';

     }

 }else{

    $cate=CoBrond::all();
    foreach ($cate as $catevalue) {
    $output.='<option value="'.$catevalue->id.'">'.$catevalue->name.'</option>';

     }

 }
    $output.='</select>';
    return $output;
    
  }

  public function setSetectedProductCate(Request $request){
  return $request->input('catId');
  }
  
/*--------- check Stock-------*/
    public function stock(){
    $stock=array();
    $allempityStock=FoodService::where('stock','0')->get()->toArray();
    $dealAllempityStock=Deal_of_day::where('stock','0')->get()->toArray();
    $stock[]=$allempityStock;
    foreach ($allempityStock as $key => $value){

    $cate=FoodCategory::where('id',$value['service_cate_id'])->get()->toArray();
    $stock[0][$key]['cate_name']=$cate[0]['category_name'];
    }
//     echo"<pre>";
//    print_r($dealAllempityStock);
// die;
    return view('admin.stock.index',['stock'=>$stock[0],'dealStock'=>$dealAllempityStock]);
    }
/*--------- check Stock -------*/

}







