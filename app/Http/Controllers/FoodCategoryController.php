<?php
namespace App\Http\Controllers;
error_reporting(1);
use App\FoodCategory;
use App\Available_city;
use App\FoodService;
use Illuminate\Http\Request;
use Session;
use DB;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foodCategory=FoodCategory::orderBy('id','desc')->get();
        return view('admin.foodCategory.index',['category'=>$foodCategory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     // $category=FoodCategory::where('type','p')->get();   
     return view('admin.foodCategory.view'); 
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
            "category_name" => 'required',
            'category_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                         ]); 

        $sreq = new FoodCategory;
        $sreq->category_name=$request->category_name; 
        $sreq->category_type=$request->category_type;
        if($request->category_img){
        $imageName = time().'.'.$request->category_img->extension();
        $request->category_img->move(public_path('uploads/foodCategory'),$imageName);
        }else{
        $imageName='NULL';
        }
        
        if($request->category_logo){
        $imageLogo = time().'.'.$request->category_logo->extension();    
        $request->category_logo->move(public_path('uploads/foodCategoryLogo'), $imageLogo);
        }else{
        $imageLogo='NULL';
            }

        if($request->category_page_logo){
        $imagePLogo = time().'.'.$request->category_page_logo->extension();    
        $request->category_page_logo->move(public_path('uploads/categoryPageLogo'), $imagePLogo);
        }else{
        $imagePLogo='NULL';
            }

        $sreq->category_img=$imageName;
        $sreq->category_logo=$imageLogo;
        $sreq->pageLogo=$imagePLogo;
     
        $sreq->topbar=$request->chktopbar;
        $sreq->homeCategorySection=$request->chkCatSec;
         
        $sreq->save();
        \Session::put('success','Data Add Successfully.');
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FoodCategory $foodCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $editData=FoodCategory::find($id);
     return view('admin.foodCategory.edit',['editData'=>$editData]);
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
        // echo $request->file();
        // return $request->input();

       $request->validate([
            "category_name" => 'required',
                     ]); 

    $sreq=FoodCategory::find($request->input('editId'));
    $sreq->category_name=$request->category_name; 

        $sreq->topbar=$request->chktopbar;
        $sreq->homeCategorySection=$request->chkCatSec;
        $sreq->category_type=$request->category_type;
     if($request->file('category_img')){
       $request->validate([
        'category_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                         ]); 
       
        $imageName = time().'.'.$request->category_img->extension();
        $sreq->category_img=$imageName;
        $request->category_img->move(public_path('uploads/foodCategory'), $imageName);
        }else{       
         $sreq->category_img=$request->input('OldImg');
           }

     if($request->file('category_logo')){
       $request->validate([
      'category_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]); 
        $imageLogo = time().'.'.$request->category_logo->extension();    
        $sreq->category_logo=$imageLogo; 
        $request->category_logo->move(public_path('uploads/foodCategoryLogo'), $imageLogo);
       }else{
    
        $sreq->category_logo=$request->input('OldLogo');
       
            }

        if($request->file('category_page_logo')){
        $imagePLogo = time().'.'.$request->category_page_logo->extension();   
        $sreq->pageLogo=$imagePLogo; 
        $request->category_page_logo->move(public_path('uploads/categoryPageLogo'), $imagePLogo);
        }else{
      
        $sreq->pageLogo=$request->input('OldPLogo');
            }

      $sreq->update();
     \Session::put('success','Data Update Successfully.');
     return redirect('/categories');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     FoodCategory::find($id)->delete();
     \Session::put('warning','Data Remove Successfully.');
     return redirect('/categories');
    }
/*----- updateCategoryStatus ----*/
    public function updateCategoryStatus(Request $request){

            $uDocData=FoodCategory::find($request->input('id'));
            $uDocData->status=$request->CatStatus;
            $uDocData->update();
    }

    public function chkTopBarShowStatus(Request $request){
    $count=FoodCategory::where('topbar','on')->get()->count();
    if($count>8){
    $retdata=array('high');
    }else{
    $retdata=array('low');
    }
    return json_encode($retdata);   
    }
 
    public function chkCatSecShowStatus(Request $request){
    $count=FoodCategory::where('homeCategorySection','on')->get()->count();
    if($count>8){
    $retdataSec=array('high');
    }else{
    $retdataSec=array('low');
    }
    return json_encode($retdataSec);   
    }

    public function categoryProduct($id,$type=''){

            if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }

        if($type=="cobrand"){
            
        $foodData=DB::table('product_cities')
        ->select('co_bronds.name as category_name','product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
        
              ->join('food_services','food_services.id','=','product_cities.product_id')
              ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')
              ->join('co_bronds','co_bronds.id','=','food_services.service_cate_id')
              ->where(['product_cities.city_id'=>$selectCity,'food_services.service_cate_id'=>$id,'product_type'=>'1','food_services.status'=>'1'])
              ->groupBY('product_price_tbls.product_id')
                    ->get();
          $cobrand='1';          
          }elseif($type=="ebc"){

            $foodData=DB::table('product_cities')
              
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')
               ->join('food_categories','food_categories.id','=','food_services.ebc_id')
               ->where(['product_cities.city_id'=>$selectCity,'food_services.ebc_id'=>$id,'food_services.product_type'=>'0','food_services.status'=>'1'])
               ->select('food_categories.category_logo','food_categories.pageLogo','food_categories.page_type','food_categories.category_name','product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
                ->groupBY('product_price_tbls.product_id')
                ->get();
                $cobrand='0';

              $CobrandFoodData=DB::table('product_cities')
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')
               ->join('co_bronds','co_bronds.id','=','food_services.service_cate_id')
               ->where(['product_cities.city_id'=>$selectCity,'food_services.ebc_id'=>$id,'food_services.product_type'=>'1','food_services.status'=>'1'])
               ->select('product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
                ->groupBY('product_price_tbls.product_id')
                ->get();
$other="1";
               $CobrandFoodOneData=DB::table('product_cities')
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')
               ->join('co_bronds','co_bronds.id','=','food_services.service_cate_id')
               ->where(['product_cities.city_id'=>$selectCity,'food_services.ebc_id'=>$id,'food_services.product_type'=>'1','food_services.status'=>'1'])
               ->orderBy('food_services.id','desc')->limit(1)
               ->select('product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
                ->groupBY('product_price_tbls.product_id')
                ->get();
            
              }else{

              $foodData=DB::table('product_cities')
              
               ->join('food_services','food_services.id','=','product_cities.product_id')
               ->join('product_price_tbls','food_services.id','=','product_price_tbls.product_id')
               ->join('food_categories','food_categories.id','=','food_services.service_cate_id')
               ->where(['product_cities.city_id'=>$selectCity,'food_services.service_cate_id'=>$id,'food_services.product_type'=>'0','food_services.status'=>'1'])
               ->select('food_categories.category_logo','food_categories.pageLogo','food_categories.page_type','food_categories.category_name','product_price_tbls.quantity','product_price_tbls.quantity_type','product_price_tbls.price','product_price_tbls.type','product_cities.city_id','food_services.id','food_services.service_name','food_services.service_img','food_services.no_of_pices','food_services.actualWeight','food_services.service_price','food_services.service_offer')
                ->groupBY('product_price_tbls.product_id')
                ->get();
                $cobrand='0';
        }

            $checkAveliableCatData=count($foodData);
            $CobrandFoodDataCount=count($CobrandFoodData);
// echo"<pre>";
// print_r($CobrandFoodOneData);
// die;
             return view('website.category',['foodData'=>$foodData,'checkAveliableCatData'=>$checkAveliableCatData,'CobrandFoodData'=>$CobrandFoodData,'CobrandFoodDataCount'=>$CobrandFoodDataCount,'CobrandFoodOneData'=>$CobrandFoodOneData,'cobrand'=>$cobrand,'other'=>$other]);
    }
    
}
