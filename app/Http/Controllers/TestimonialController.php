<?php
namespace App\Http\Controllers;
use App\Testimonial;
use Illuminate\Http\Request;
use Session;
use App\Booking;
error_reporting(1);
class TestimonialController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonial=Testimonial::orderBy('id','desc')->get();
        return view('admin.testimonial.index',['testimonial'=>$testimonial]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('admin.testimonial.view'); 
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
            "clint_name" => 'required',
            'clint_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'clint_message'=>'required|min:30',
                     ]); 
        $sreq = new Testimonial;
        $sreq->clint_name=$request->clint_name; 
        $sreq->clint_msg=$request->clint_message; 

        $sreq->clint_designation=$request->clint_designation; 
        $sreq->clint_fb_url=$request->clint_fb_url; 
        $sreq->clint_insta_url=$request->clint_insta_url; 
        
        $sreq->client_rate=$request->client_rate; 
        $imageName = time().'.'.$request->clint_img->extension();  
        $sreq->clint_img=$imageName;
        $request->clint_img->move(public_path('uploads/testimonial'), $imageName);
        $sreq->save();        
        \Session::put('success','Data Add Successfully.');
        return redirect('/testimonials');
    }

        public function submitRating(Request $request){

            // $request->validate([
            // "rating" => 'required',
            // 'comment' => 'required',
            //                  ]);

          if($request->editId){
            $bokId=$request->editId;
          }else{
            $bok=Booking::where('order_id',session()->get('orderId'))->get()->toArray();
            $bokId=$bok[0]['id'];
          }           
            $sreq=Booking::find($bokId);
            $sreq->clint_msg=$request->comment; 
            $sreq->client_rate=$request->rating;
            $sreq->update();

          if($request->editId){
           return redirect('user-profile');
          }else{
            session()->forget('orderId');
            return redirect('/');
          } 
         }

    /**
     * Display the specified resource.
     *
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $serviceData=Testimonial::find($id);
      return view('admin.testimonial.detail',['testDetails'=>$serviceData]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $editData=Testimonial::find($id);
     return view('admin.testimonial.edit',['editData'=>$editData]);
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
       $request->validate([
            "clint_name" => 'required',
            'clint_message'=>'required|min:30',
                     ]); 
       $sreq=Testimonial::find($request->input('editId'));


        $sreq->clint_designation=$request->clint_designation; 
        $sreq->clint_fb_url=$request->clint_fb_url; 
        $sreq->clint_insta_url=$request->clint_insta_url; 

        $sreq->client_rate=$request->client_rate; 
        $sreq->clint_name=$request->clint_name; 
        $sreq->clint_msg=$request->clint_message; 
     if($request->file('clint_img')){
       $request->validate([
       'clint_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]); 
       
        $imageName = time().'.'.$request->clint_img->extension();  
        $sreq->clint_img=$imageName;
        $request->clint_img->move(public_path('uploads/testimonial'), $imageName);
     }else{
     $sreq->clint_img=$request->input('oldImg');
     }
     $sreq->update();
     \Session::put('success','Data Update Successfully.');
     return redirect('/testimonials');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     Testimonial::find($id)->delete();
     \Session::put('warning','Data Remove Successfully.');
     return redirect('/testimonials');
    }
/*----- updateCategoryStatus ----*/
    public function updateTestimonialStatus(Request $request){
            $uDocData=Testimonial::find($request->input('id'));
            $uDocData->status=$request->testStatus;
            $uDocData->update();
            session()->forget('tatalPayAMT');
    }

    public function testimonialDetails(Request $req){
         $id=$req->id;
         $testimonialData=Testimonial::find($id);
$output='';
 $output.='<div style="width:110px; height:110px; margin:0px auto 10px auto; ;">
                            <img src="'.asset("uploads/testimonial/".$testimonialData->clint_img).'" class="img-circle" style="width:100%; height:100%; object-fit:cover; border-radius: 100px;" alt=""> </div>

                         <div style="margin-bottom:20px;">
                            <h3 style="color: rgb(247, 57, 57);">'.$testimonialData->clint_name.'</h3>
                        <span style="font-size: 1.1em; font-weight: 600;">'.$testimonialData->clint_designation.'</span>';

                $output.='<p style="margin:0px">';
                          
                           $rate=explode('.',$testimonialData->client_rate);
                           $fullRate=$rate[0];
                           $halfRate=$rate[1];
                           for($k=1;$k<=5;$k++){
                           if(ceil($fullRate)>=$k){
                            
                $output.='<span class="fa fa-star mr-1"></span>';
                       
                             }else{
                        if($halfRate==5){
                       
                 $output.='<span class="fa fa-star-half-o mr-1" style="color: #e11e28;cursor:pointer"></span>';
                          
                          $halfRate=0;
                               }else{
                 $output.='<span class="fa fa-star-o mr-1"></span>';
                               }
                             }

                            }
                $output.='</p>';

                $output.='<a href="'.$testimonialData->clint_fb_url.'" style="z-index:99999999;cursor:pointer !important"><i class="fa fa-facebook-square" style="font-size:25px;color:#3a5794; margin-top: 4px;"></i></a>
                    <a href="'.$testimonialData->clint_insta_url.'" style="z-index:99999999;cursor:pointer !important"><i class="fa fa-instagram" style="font-size:25px;color:#d62977;padding-left:10px; margin-top: 4px;"></i></a>
                        </div>
                        <div>
                        <p style="font-weight: 400;"> 
                         '.$testimonialData->clint_msg.'
                        </div>';

                return $output;
 
    }

}

