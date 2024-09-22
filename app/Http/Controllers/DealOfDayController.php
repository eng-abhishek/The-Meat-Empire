<?php

namespace App\Http\Controllers;
error_reporting(1);
use App\FoodService;
use App\FoodCategory;
use App\Deal_of_day;
use App\Dealofdayprice_tbl;
use Session;
use Illuminate\Http\Request;

class DealOfDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $DealOfDay=Deal_of_day::orderBy('id','desc')->get();
       return view('admin.deal_of_day.index',['DealOfDay'=>$DealOfDay]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
     $serviceCategory=FoodCategory::all();  
     $FoodService= FoodService::all(); 
     return view('admin.deal_of_day.view',['serviceCategory'=>$serviceCategory,'FoodService'=>$FoodService]); 
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
           "foodName"=>'required',
           "productImg"=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',    
                         ]); 

             if($request->stoctQtyType=='gram'){
              $actQtyStock=$request->qtyStorage*1000;
               }else{
              $actQtyStock=$request->qtyStorage;
                    }

        $sreq = new Deal_of_day;
        $sreq->foodName=$request->foodName; 
        // $sreq->price=$request->price; 
       
        $sreq->offer=$request->offer;
        $sreq->stock=$actQtyStock;  
        $sreq->stoctQtyType=$request->stoctQtyType;  

        $imageName = time().'.'.$request->productImg->extension();  
        $sreq->productImg=$imageName;
        $request->productImg->move(public_path('uploads/dealOfDay'), $imageName);
        $sreq->save();
        $productId=$sreq->id; 
   
if($request->qtytype=='weigth'){

 for($k=0;$k<count($request->priceW);$k++){
 
$productPriceW=new Dealofdayprice_tbl;
$productPriceW->quantity=$request->weight[$k];
$productPriceW->quantity_type=$request->meagurementType[$k];
$productPriceW->price=$request->priceW[$k];
$productPriceW->type=$request->qtytype;
$productPriceW->product_id=$productId;

$productPriceW->save();

}
}elseif($request->qtytype=='piece'){

 for($l=0;$l<count($request->pricePI);$l++){

$productPricePI=new Dealofdayprice_tbl;
$productPricePI->quantity=$request->piece[$l];
$productPricePI->quantity_type='piece';
$productPricePI->price=$request->pricePI[$l];
$productPricePI->type=$request->qtytype;
$productPricePI->product_id=$productId;

 $productPricePI->save();

 }

}elseif($request->qtytype=='plate'){

for($m=0;$m<count($request->pricePL);$m++){


$productPriceP=new Dealofdayprice_tbl;
$productPriceP->quantity=$request->plate[$m];
$productPriceP->quantity_type='plate';
$productPriceP->price=$request->pricePL[$m];
$productPriceP->type=$request->qtytype;
$productPriceP->product_id=$productId;

 $productPriceP->save();


}


}else{
}
        \Session::put('success','Data Add Successfully.');
        return redirect('/deal-of-day');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deail_of_day  $deail_of_day
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    $pricetblDetail=array();
    $DealOfDay=Deal_of_day::select('id','foodName','productImg')->find($id)->toArray();
    $pricetblDetail[]=$DealOfDay;

     $pricetable=Dealofdayprice_tbl::where('product_id',$id)->get()->toArray();
      foreach($pricetable as $key => $priceValue){
      $pricetblDetail[0]['price'][$key][]=$priceValue;
      }
         return view('admin.deal_of_day.detail',['dealOfDayDetails'=>$pricetblDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deail_of_day  $deail_of_day
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
    {
     $serviceCategory=FoodCategory::all();  
     $FoodService= FoodService::all(); 
     $DealOfDay=Deal_of_day::find($id);
     return view('admin.deal_of_day.edit',['serviceCategory'=>$serviceCategory,'FoodService'=>$FoodService,'DealOfDay'=>$DealOfDay]); 
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

     //return $request->input();

      if($request->stoctQtyType=='gram'){
        $actQtyStock=$request->qtyStorage*1000;
      }else{
        $actQtyStock=$request->qtyStorage;
      }
            $request->validate([
           "foodName"=>'required',
                              ]); 

        $sreq = Deal_of_day::find($request->editId);
        $sreq->foodName=$request->foodName; 
        $sreq->offer=$request->offer;
        $sreq->stock=$actQtyStock;
        $sreq->stoctQtyType=$request->stoctQtyType; 

         if($request->productImg){
        $request->validate([
         "productImg"=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                  ]); 
        $imageName = time().'.'.$request->productImg->extension();  
        $sreq->productImg=$imageName;
        $request->productImg->move(public_path('uploads/dealOfDay'), $imageName);
         }else{
        $sreq->productImg=$request->input('OldImg');
         }
        $sreq->update();

        $productId=$request->editId; 
        Dealofdayprice_tbl::where('product_id',$productId)->delete();

if($request->qtytype=='weigth'){

for($k=0;$k<count($request->priceW);$k++){
$productPrice=new Dealofdayprice_tbl;
$productPrice->quantity=$request->weight[$k];
$productPrice->quantity_type=$request->meagurementType[$k];
$productPrice->price=$request->priceW[$k];
$productPrice->type=$request->qtytype;
$productPrice->product_id=$productId;
$productPrice->save();

}
}elseif($request->qtytype=='piece'){

for($l=0;$l<count($request->pricePC);$l++){
    $productPrice=new Dealofdayprice_tbl;
$productPrice->quantity=$request->piece[$l];
$productPrice->quantity_type='piece';
$productPrice->price=$request->pricePC[$l];
$productPrice->type=$request->qtytype;
$productPrice->product_id=$productId;
$productPrice->save();
}
}elseif($request->qtytype=='plate'){

for($m=0;$m<count($request->pricePL);$m++){
    $productPrice=new Dealofdayprice_tbl;
$productPrice->quantity=$request->plate[$m];
$productPrice->quantity_type='plate';
$productPrice->price=$request->pricePL[$m];
$productPrice->type=$request->qtytype;
$productPrice->product_id=$productId;
$productPrice->save();
}
}else{
}

        \Session::put('success','Data Update Successfully.');
         return redirect('/deal-of-day');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deail_of_day  $deail_of_day
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Deal_of_day::find($id)->delete();
     \Session::put('warning','Data Remove Successfully.');
     return redirect('/deal-of-day');
    }

    /*----- updateDealOfDayStatus ----*/
    public function updateDealOfDayStatus(Request $request){

            $uDocData=Deal_of_day::find($request->input('id'));
            $uDocData->status=$request->servStatus;
            $uDocData->update();
    }

   public function getDealofDayQtyType(Request $request){
     $pricetype=Dealofdayprice_tbl::where('product_id',$request->editId)->get();
    return json_encode($pricetype[0]->type);
    }


    public function removeDealOfDayPriceTbl(Request $request){
    Dealofdayprice_tbl::where('id',$request->id)->delete();
     }


   public function getDealOfDayPriceTable(Request $request){
   $pricetype=Dealofdayprice_tbl::where('product_id',$request->editId)->get();
   
   $outputArr=array();
   $output='';
   $type=array();
   if($pricetype[0]->type=='weigth'){
    $selectgram='';
    $selectkilogram='';
foreach ($pricetype as $weightKey => $priceTypeValue) {
if($priceTypeValue->quantity_type=='gram'){
$selectgram='selected';
$selectkilogram='';
}else{
$selectgram='';
$selectkilogram='selected';
}

if($weightKey==0){
$output.='<div class="row"><div class="col-md-3"><div class="form-group"><label for="weight">Enter Weight</label><input type="number" value="'.$priceTypeValue->quantity.'" name="weight[]" min="1" class="form-control" required=""></div></div>';
$output.='<div class="col-md-2"><div class="form-group"><label for="qty_type">Select Quantity</label><select name="meagurementType[]" class="form-control qty_type" required><option value="">Select Quantity</option><option '.$selectgram.'  value="gram">Gram</option><option '.$selectkilogram.' value="kilo-gram">Kilo Gram</option></select></div></div>';
$output.='<div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" name="priceW[]" min="1" value="'.$priceTypeValue->price.'" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" onclick="addMoreWeightDB()" class="btn btn-success"><i class="fa fa-plus"></i></button></div></div><div class="col-md-2"></div></div>';
   }else{

$output.='<div class="row removeItemDB'.$priceTypeValue->id.'"><div class="col-md-3"><div class="form-group"><label for="weight">Enter Weight</label><input type="number" value="'.$priceTypeValue->quantity.'" name="weight[]" min="1" class="form-control" required=""></div></div>';
$output.='<div class="col-md-2"><div class="form-group"><label for="qty_type">Select Quantity</label><select name="meagurementType[]" class="form-control qty_type" required><option value="">Select Quantity</option><option '.$selectgram.'  value="gram">Gram</option><option '.$selectkilogram.' value="kilo-gram">Kilo Gram</option></select></div></div>';
$output.='<div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" name="priceW[]" min="1" value="'.$priceTypeValue->price.'" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger" onclick="removeItemDB('.$priceTypeValue->id.')"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div></div>';
   }
   }   
$type[0]='weigth';
   }elseif($pricetype[0]->type=='plate'){
foreach ($pricetype as $plateKey => $priceTypeValue) {
if($plateKey==0){
$output.='<div class="row"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Plate</label><input type="number" min="1" name="plate[]" class="form-control" value="'.$priceTypeValue->quantity.'" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" name="pricePL[]" min="1" value="'.$priceTypeValue->price.'" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-success" onclick="addPlateItemDB()"><i class="fa fa-plus"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>';

}else{
$output.='<div class="row removeItemDB'.$priceTypeValue->id.'"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Plate</label><input type="number" name="plate[]" class="form-control" min="1" value="'.$priceTypeValue->quantity.'" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" value="'.$priceTypeValue->price.'" name="pricePL[]" min="1" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger" onclick="removeItemDB('.$priceTypeValue->id.')"><i class="fa fa-remove"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>';
}

}
$type[0]='plate';
   }elseif($pricetype[0]->type=='piece'){

foreach ($pricetype as $pieceKey => $priceTypeValue) {
if($pieceKey==0){ 
$output.='<div class="row"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Piece</label><input type="number" min="1" value="'.$priceTypeValue->quantity.'" name="piece[]" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input min="1" type="number" value="'.$priceTypeValue->price.'" name="pricePC[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" onclick="addPiceItemDB()" class="btn btn-success"><i class="fa fa-plus"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>';

}else{
$output.='<div class="row removeItemDB'.$priceTypeValue->id.'"><div class="col-md-3"><div class="form-group"><label for="weight">Enter No Of Piece</label><input type="number" name="piece[]" min="1" value="'.$priceTypeValue->quantity.'" class="form-control" required=""></div></div><div class="col-md-3"><div class="form-group"><label for="price">Enter Price</label><input type="number" min="1" value="'.$priceTypeValue->price.'" name="pricePC[]" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label></label><button type="button" class="btn btn-danger"><i class="fa fa-remove" onclick="removeItemDB('.$priceTypeValue->id.')"></i></button></div></div><div class="col-md-2"></div><div class="col-md-2"></div></div>';
}
}
$type[0]='piece';
   }else{

   }
   $outputArr[1]=$output;
   $result[]=$type[0];
   $result[]=$outputArr[1];
   return $result;
   }

}
