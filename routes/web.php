<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['prevent-back-history','adminLoginAuth']],function(){
/*------- admin dashboard ---*/	
Route::get('admin-dashboard','AdminController@adminDashboard')->name('admin-dashboard');

});

Route::get('/forget-password','AdminController@forgetPassword')->name('forget-password');


Route::group(['middleware' => ['prevent-back-history','AdminbasicAuth']],function(){
Route::get('/admin-login','AdminLoginController@index')->name('admin-login');
Route::post('check-adminLogin','AdminLoginController@checklogin')->name('check-adminLogin');

});


Route::get('/','HomeController@index');

Route::get('admin-logout','AdminLoginController@adminLogout')->name('admin-logout');

/*------  user login -----*/
Route::get('user-logout','UserController@userLogout')->name('user-logout');
Route::get('user-profile','UserController@userProfile')->name('user-profile');
Route::post('add-user-picture','UserController@addProfilePicrure')->name('add-user-picture');
Route::post('update-user-profile','UserController@updateUserProfile')->name('add-user-picture');

Route::get('user-detail/{id}','UserController@details')->name('user-detail');
Route::get('user-edit/{id}','UserController@edit')->name('user-edit');
Route::post('user-update','UserController@update')->name('user-update');
Route::post('getUserLocation','UserController@getUserLocation')->name('getUserLocation');

/*------  end user login -----*/

/*------- food category------*/

Route::get('/categories','FoodCategoryController@index')->name('category-view');
Route::get('/category-add','FoodCategoryController@create')->name('category-add');
Route::post('/category-store','FoodCategoryController@store')->name('category-store');
Route::get('/category-show/{id}','FoodCategoryController@show')->name('category-show');
Route::get('/category-edit/{id}','FoodCategoryController@edit')->name('category-edit');
Route::get('/category-edit/{id}/{type}','FoodCategoryController@edit')->name('category-edit');

Route::post('/category-update','FoodCategoryController@update')->name('category-update');
Route::get('/category-destroy/{id}','FoodCategoryController@destroy')->name('category-destroy');
Route::post('/update-category-status','FoodCategoryController@updateCategoryStatus')->name('update-category-status');

Route::post('/chk-top-bar-show-status','FoodCategoryController@chkTopBarShowStatus')->name('chk-top-bar-show-status');

Route::post('/chk-cat-sec-show-status','FoodCategoryController@chkCatSecShowStatus')->name('chk-cat-sec-show-status');

Route::get('/category-product/{id}','FoodCategoryController@categoryProduct')->name('category-product');


Route::get('/category-product/{id}/{cobrand}','FoodCategoryController@categoryProduct')->name('category-product');

// Route::post('/co-brand/{id}','FoodCategoryController@categoryProduct')->name('setSetectedProductCate');
/*------- food services------*/

Route::get('/product','FoodServiceController@index')->name('product-view');
Route::get('/product-add','FoodServiceController@create')->name('product-add');
Route::post('/product-store','FoodServiceController@store')->name('product-store');
Route::get('/product-show/{id}','FoodServiceController@show')->name('product-show');
Route::get('/product-edit/{id}','FoodServiceController@edit')->name('product-edit');
Route::get('/product-edit/{id}/{type}','FoodServiceController@edit')->name('product-edit');
Route::post('/product-update','FoodServiceController@update')->name('product-update');
Route::get('/product-destroy/{id}','FoodServiceController@destroy')->name('product-destroy');
Route::post('/update-service-status','FoodServiceController@updateCategoryStatus')->name('update-services-status');
Route::post('/chk-home-serv-sec-show-status','FoodServiceController@chkHomeServSecShowStatus')->name('chk-home-serv-sec-show-status');

Route::get('/product-detail/{id}','FoodServiceController@productDetail')->name('product-detail');
Route::get('/product-detail/{id}/{cobrand}','FoodServiceController@productDetail')->name('product-detail');

Route::post('/remove-product-price-item','FoodServiceController@removeProductPriceItem')->name('remove-product-price-item');

Route::post('/getProductCateType','FoodServiceController@getProductCateType')->name('getProductCateType');

Route::post('/setSetectedProductCate','FoodServiceController@setSetectedProductCate')->name('setSetectedProductCate');

Route::post('/checkStockAvaliablity','FoodServiceController@checkStockAvaliablity')->name('checkStockAvaliablity');
Route::get('/stock','FoodServiceController@stock')->name('stock');

/*------- food testimonial------*/

Route::get('/testimonials','TestimonialController@index')->name('testimonial-view');
Route::get('/testimonial-add','TestimonialController@create')->name('testimonial-add');
Route::post('/testimonial-store','TestimonialController@store')->name('testimonial-store');
Route::get('/testimonial-show/{id}','TestimonialController@show')->name('testimonial-show');
Route::get('/testimonial-edit/{id}','TestimonialController@edit')->name('testimonial-edit');
Route::post('/testimonial-update','TestimonialController@update')->name('testimonial-update');
Route::get('/testimonial-destroy/{id}','TestimonialController@destroy')->name('testimonial-destroy');
Route::post('/update-testimonial-status','TestimonialController@updateTestimonialStatus')->name('update-testimonial-status');

Route::post('/submit-rating','TestimonialController@submitRating')->name('submit-rating');

Route::post('/readMoreTestimonial','TestimonialController@testimonialDetails')->name('readMoreTestimonial');


/*------- deal of day ------*/
Route::get('/deal-of-day','DealOfDayController@index')->name('deal-of-day-view');
Route::get('/deal-of-day-add','DealOfDayController@create')->name('deal-of-day-add');
Route::post('/deal-of-day-store','DealOfDayController@store')->name('deal-of-day-store');
Route::get('/deal-of-day-show/{id}','DealOfDayController@show')->name('deal-of-day-show');
Route::get('/deal-of-day-edit/{id}','DealOfDayController@edit')->name('deal-of-day-edit');
Route::post('/deal-of-day-update','DealOfDayController@update')->name('deal-of-day-update');
Route::get('/deal-of-day-destroy/{id}','DealOfDayController@destroy')->name('deal-of-day-destroy');
Route::post('/update-deal-of-day-status','DealOfDayController@updateDealOfDayStatus')->name('update-deal-of-day-status');

Route::post('/get-deal-of-day-qty-type','DealOfDayController@getDealofDayQtyType')->name('get-deal-of-day-qty-type');

Route::post('/get-deal-of-day-price-table','DealOfDayController@getDealOfDayPriceTable')->name('get-deal-of-day-price-table');

Route::post('/remove-deal-of-day-price-tbl','DealOfDayController@removeDealOfDayPriceTbl')->name('remove-deal-of-day-price-tbl');


/*------- co brand------*/

Route::get('/co-brand','CobrandsController@index')->name('co-brand-view');
Route::get('/co-brand-add','CobrandsController@create')->name('co-brand-add');
Route::post('/co-brand-store','CobrandsController@store')->name('co-brand-store');
Route::get('/co-brand-show/{id}','CobrandsController@show')->name('co-brand-show');
Route::get('/co-brand-edit/{id}','CobrandsController@edit')->name('co-brand-edit');
Route::post('/co-brand-update','CobrandsController@update')->name('co-brand-update');
Route::get('/co-brand-destroy/{id}','CobrandsController@destroy')->name('co-brand-destroy');
Route::post('/update-co-brand-status','CobrandsController@updateCoBrandStatus')->name('update-co-brand-status');

Route::get('/co-brand-detail/{id}','CobrandsController@productDetail')->name('co-brand-detail');
/*------- co brand------*/

/*-------- cart -------*/

Route::post('/cart-count','CartController@countCart')->name('cart-count');

Route::post('/decrise-count','CartController@decrise_countCart')->name('decrise-count');

Route::post('/special-cart-count','CartController@special_countCart')->name('cart-count');
Route::post('/special-decrise-count','CartController@special_decrise_countCart')->name('decrise-count');

Route::get('/cart','CartController@index')->name('cart');

Route::post('/check-coupon','CartController@checkCoupon')->name('check-coupon');
Route::post('/add-to-cart','CartController@addToCart')->name('add-to-cart');

// Route::get('/cart/{id}/{special}','CartController@addToCart')->name('add-to-cart');

Route::post('/add-to-cart-product','CartController@addToCartAtProductPage')->name('add-to-cart-product');

Route::patch('update-cart', 'CartController@update')->name('update-cart');

Route::delete('/remove-from-cart','CartController@remove')->name('remove-from-cart');

Route::delete('/remove-special-from-cart','CartController@removeSpecialProductPriceItem')->name('remove-special-from-cart');

Route::post('/update-product-price-cart','CartController@updateProductCart')->name('update-product-price-cart');


Route::post('/update-special-product-price-cart','CartController@updateSpeProductCart')->name('update-special-product-price-cart');

Route::post('/getCartCount','CartController@getCartCount')->name('getCartCount');


Route::post('/cart-count-product-page','CartController@countCartProductPage')->name('cart-count-product-page');

Route::post('/decrise-count-product-page','CartController@decrise_countCartProductPage')->name('decrise-count-product-page');

Route::post('/cartBill','CartController@cartBill')->name('cartBill');

Route::get('/removeCart','CartController@removeCart')->name('removeCart');


Route::post('/cartDetails','CartController@cartDetails')->name('cartDetails');
/* final page */

Route::post('/getFinalPageCartDetails','CartController@getFinalPageCartDetails')->name('getFinalPageCartDetails');

Route::post('/getFinalPageBillDetails','CartController@getFinalPageBillDetails')->name('getFinalPageBillDetails');

Route::post('/removeCartItem','CartController@removeCartItem')->name('removeCartItem');

Route::post('/applyCouponCode','CartController@applyCouponCode')->name('applyCouponCode');

Route::post('/applyNormalCoupon','CartController@applyNormalCoupon')->name('applyNormalCoupon');

Route::post('/getUserInstruction','CartController@getUserInstruction')->name('getUserInstruction');

Route::post('/checkExpressDelivery','CartController@checkExpressDelivery')->name('checkExpressDelivery');
Route::post('/apply-coupon','CartController@applyNewCoupon')->name('apply-coupon');

Route::post('/removeCoupon','CartController@removeCoupon')->name('removeCoupon');

Route::get('/repeat-order/{id}','CartController@repeatOrder')->name('repeat-order');

Route::post('/updateCutInst','CartController@updateCutInst')->name('updateCutInst');

Route::post('/paymentMode','CartController@paymentMode')->name('paymentMode');

/* final page */

/* product cart page ----*/

Route::post('/showqtyPriceProductPage','CartController@showqtyPriceProductPage')->name('showqtyPriceProductPage');
/* product cart page ----*/

Route::post('/setpaymentIdSession','CartController@getTransationId')->name('setpaymentIdSession');


/*-------- end cart -------*/
Route::post('/product-by-city','HomeController@productByCity')->name('product-by-city');
/*---------- user login ---------*/


Route::get('/user-login','HomeController@userlogin')->name('user-login');
Route::get('/user-login/{checkout}','HomeController@userlogin')->name('user-login');

/*----------end user login ---------*/

/*------ search Filter -----*/

Route::get('/search','HomeController@searchProduct')->name('search');

Route::post('/get-product-category','HomeController@getProductCategory')->name('get-product-category');

Route::post('/get-search-product','HomeController@getSearchProduct')->name('get-search-product');

/*------ search Filter -----*/
/*----- checkcityCategory ----*/

Route::post('/checkcityCategory','HomeController@checkcityCategory')->name('checkcityCategory');
/*----- checkcityCategory ---*/
/*--------- coupon --------*/

Route::get('/coupon','CouponController@index')->name('coupon-view');
Route::get('/coupon-add','CouponController@create')->name('Coupon-add');
Route::post('/coupon-store','CouponController@store')->name('Coupon-store');
Route::get('/coupon-show/{id}','CouponController@show')->name('Coupon-show');
Route::get('/coupon-edit/{id}','CouponController@edit')->name('Coupon-edit');
Route::post('/coupon-update','CouponController@update')->name('Coupon-update');
Route::get('/coupon-destroy/{id}','CouponController@destroy')->name('Coupon-destroy');
Route::post('/update-coupon-status','CouponController@updateCouponStatus')->name('update-coupon-status');
Route::post('/get-update-coupon-code-page-status','CMSController@getUpdateCouponCodePageStatus')->name('get-update-coupon-code-page-status');
Route::get('/cms-coupon','CMSController@couponView')->name('cms-coupon');

Route::post('/store-cms-coupon','CMSController@showCouponOnCartPage')->name('store-cms-coupon');
Route::get('/offer','CouponController@alloffer')->name('offer');

/*--------- end coupon --------*/

/*------- tax ------*/
Route::get('/tax','TaxController@index')->name('tax');
Route::post('/tax-store','TaxController@store')->name('tax-store');
/*------- tax ------*/

/*--------- CMS ----------*/
Route::get('/cms-topbar-category','CMSController@topBarCategoryView')->name('cms-topbar-category');

Route::post('/store-cms-topbar-category','CMSController@topBarCategoryStore')->name('store-cms-topbar-category');


Route::get('/cms-explore-by-category','CMSController@exploreByCategoryView')->name('cms-explore-by-category');

Route::post('/store-cms-explore-by-category','CMSController@exploreByCategoryStore')->name('store-cms-explore-by-category');

Route::get('/cms-best-seller','CMSController@bestSellerView')->name('cms-best-seller');

Route::post('/store-cms-best-seller','CMSController@bestSellerStore')->name('store-cms-best-seller');


Route::get('/cms-deal-of-day','CMSController@dealofDayView')->name('cms-deal-of-day');

Route::post('/store-cms-deal-of-day','CMSController@dealofDayStore')->name('store-cms-deal-of-day');

Route::post('/get-update-top-bar-status','CMSController@getUpdatetopBarCateStatus')->name('get-update-top-bar-status');


Route::post('/get-update-explore-category-home-page-status','CMSController@getUpdateExploreCategoryHomePageStatus')->name('get-update-explore-category-home-page-status');

Route::post('/get-update-deal-home-page-status','CMSController@getUpdateDealHomePageStatus')->name('get-update-deal-home-page-status');

Route::post('/get-update-best-seller-home-page-status','CMSController@getUpdateBestSellerHomePageStatus')->name('get-update-best-seller-home-page-status');

/*--------- end CMS ----------*/

/*--------- otp -------*/

Route::post('/send-otp','OtpController@sendotp')->name('send-otp');
Route::get('/send-otp','OtpController@sendotp')->name('send-otp');
Route::post('/match-otp','OtpController@matchotp')->name('match-otp');
Route::get('/otp','OtpController@otpview')->name('otp');

/*--------- otp -------*/

/*---- use ------*/

Route::post('/store-user-address','UserController@store_user_address')->name('store-user-address');

Route::get('/user-address','UserController@user_address')->name('user-address');
Route::get('/user-address/{id}','UserController@user_address')->name('user-address');



/*---- end use ------*/

/*----- order management ------*/

Route::get('/order','OrderController@getOrder')->name('order');
Route::get('/order-detail/{id}','OrderController@getOrderDetail')->name('order-detail');

Route::get('/order-success','UserController@orderSuccess')->name('order-success');

Route::get('/rate','CartController@rating')->name('rate');
Route::post('/change-booking-status','OrderController@changeBokStatus')->name('change-booking-status');
Route::post('/cancel-order','OrderController@cancelOrder')->name('cancel-order');
Route::get('order-history/{id}','OrderController@getOrderDetailForUser')->name('order-history');

/*----- order management ------*/

/*------ report management ----*/

Route::get('/order-report','ReportController@bookingReport')->name('order');
Route::post('/order-report','ReportController@bookingReport')->name('order');

Route::get('/payment-report','ReportController@paymentReport')->name('order-detail');

Route::post('/payment-report','ReportController@paymentReport')->name('order-detail');


Route::get('/order-report-excel','ReportController@bookingReportExcel')->name('order-report-excel');

Route::get('/payment-report-export-excel','ReportController@paymentReportExcel')->name('payment-report-export-excel');

/*------ report management ----*/

/*-------- user management ------*/
Route::get('/user','UserController@index')->name('user');
/*-------- user management ------*/

/*---------get-user-location ------*/
Route::post('/get-user-location','UserController@getLocation')->name('get-user-location');
/*---------get-user-location ------*/

/*-------- discount --------*/
Route::get('/discount','DiscountController@index')->name('discount');
Route::get('/discount-edit/{id}','DiscountController@edit')->name('edit-discount');
Route::post('/discount-update','DiscountController@update')->name('update-discount');
Route::post('/update-discount-status','DiscountController@updateDiscountStatus')->name('update-discount-status');


Route::get('/signup-discount','SignupDicountController@index')->name('signup-discount');
Route::post('/signup-discount-update','SignupDicountController@update')->name('signup-discount');
Route::get('/signup-discount-edit/{id}','SignupDicountController@edit')->name('signup-discount-edit');
Route::post('/signup-discount-status','SignupDicountController@updateSignUpDiscountStatus')->name('signup-discount-status');




Route::get('/happy-hours-discount','HappyHoursDicountController@index')->name('happy-hours-discount');
Route::get('/happy-hours-discount-edit/{id}','HappyHoursDicountController@edit')->name('happy-hours-discount-edit');
Route::post('/happy-hours-discount-update','HappyHoursDicountController@update')->name('happy-hours-discount');
Route::post('/happy-hours-discount-status','HappyHoursDicountController@updateHappyHoursDiscountStatus')->name('happy-hours-discount-status');
/*-------- discount --------*/

/* ---- Launching Discount ------*/

Route::get('/launching-discount','LaunchingDiscountController@index')->name('launching-discount');
Route::get('/launching-discount-edit/{id}','LaunchingDiscountController@edit')->name('launching-discount-edit');
Route::post('/launching-discount-update','LaunchingDiscountController@update')->name('launching-discount-update');
Route::post('/update-launching-discount-status','LaunchingDiscountController@updateLaunchingStatus')->name('update-launching-discount-status');

/*----- Launchning Discount -----*/

/*---------- cutting instructions -----*/

Route::get('/cutting-instructions-view','CuttingInstructionController@index')->name('cutting-instructions-view');
Route::post('/cutting-instructions-add','CuttingInstructionController@store')->name('cutting-instructions-add');

/*---------- cutting instructions -----*/

/*-------- delivery City ------------*/
Route::get('/city','DeliveryLocationController@index')->name('city');
Route::get('/city-edit/{id}','DeliveryLocationController@edit')->name('city-edit');
Route::post('/city-update','DeliveryLocationController@update')->name('city-update');

Route::get('/min-order-amount','DeliveryLocationController@minOrderAmount')->name('min-order-amount');
Route::get('/min-order-amount-edit/{id}','DeliveryLocationController@minOrderAmountEdit')->name('min-order-amount-edit');
Route::post('/min-order-amount-update','DeliveryLocationController@minOrderAmountUpdate')->name('min-order-amount-update');
/*-------- end delivery City ------------*/

/*--- other pages -------*/
Route::get('about-us/', function () {
    return view('website.about_us');
});
Route::get('refund-policy/', function () {
    return view('website.refoundPolicy');
});
Route::get('faq/', function () {
    return view('website.faq');
});

Route::get('instructions/', function () {
    return view('website.instructions');
});

Route::get('what-we-guarantee/', function () {
    return view('website.why_meat_empire');
});


Route::get('/privacy-policy','HomeController@privacyPolicy')->name('privacy-policy');
Route::get('/terms-condition','HomeController@termscondition')->name('terms-condition');
/*-------- other Page ----------*/


/*------ location management ----*/

Route::get('/sector','LocationController@index')->name('sector');
Route::get('/sector-add','LocationController@create')->name('sector-add');
Route::post('/sector-store','LocationController@store')->name('sector-store');
Route::get('/sector-show/{id}','LocationController@show')->name('sector-show');
Route::get('/sector-edit/{id}','LocationController@edit')->name('sector-edit');
Route::post('/sector-update','LocationController@update')->name('sector-update');
Route::get('/sector-destroy/{id}','LocationController@destroy')->name('sector-destroy');
Route::post('/update-sector-status','LocationController@updateSectorStatus')->name('update-sector-status');
Route::post('/getSelectedSector','HomeController@getSelectedSector')->name('getSelectedSector');
/*------ end location management ----*/
Route::get('/invoice','OrderController@getInvoice')->name('invoice');
Route::get('/invoice/{id}','OrderController@getInvoice')->name('invoice');


