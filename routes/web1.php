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

Route::post('/remove-product-price-item','FoodServiceController@removeProductPriceItem')->name('remove-product-price-item');

/*------- food testimonial------*/

Route::get('/testimonials','TestimonialController@index')->name('testimonial-view');
Route::get('/testimonial-add','TestimonialController@create')->name('testimonial-add');
Route::post('/testimonial-store','TestimonialController@store')->name('testimonial-store');
Route::get('/testimonial-show/{id}','TestimonialController@show')->name('testimonial-show');
Route::get('/testimonial-edit/{id}','TestimonialController@edit')->name('testimonial-edit');
Route::post('/testimonial-update','TestimonialController@update')->name('testimonial-update');
Route::get('/testimonial-destroy/{id}','TestimonialController@destroy')->name('testimonial-destroy');
Route::post('/update-testimonial-status','TestimonialController@updateTestimonialStatus')->name('update-testimonial-status');

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

Route::get('/cart','CartController@index')->name('cart');

Route::post('/check-coupon','CartController@checkCoupon')->name('check-coupon');
Route::get('/add-to-cart/{id}','CartController@addToCart')->name('add-to-cart');

Route::get('/add-to-cart/{id}/{special}','CartController@addToCart')->name('add-to-cart');

Route::patch('update-cart', 'CartController@update')->name('update-cart');

Route::delete('/remove-from-cart','CartController@remove')->name('remove-from-cart');

Route::delete('/remove-special-from-cart','CartController@removeSpecialProductPriceItem')->name('remove-special-from-cart');

Route::get('/update-product-price-cart/{productid}/{pricetblId}','CartController@updateProductCart')->name('update-product-price-cart');


Route::get('/update-special-product-price-cart/{productid}/{pricetblId}','CartController@updateSpeProductCart')->name('update-special-product-price-cart');

/*-------- end cart -------*/
Route::get('/product-by-city/{id}','HomeController@productByCity')->name('product-by-city');
/*---------- user login ---------*/
Route::get('/user-login','HomeController@userlogin')->name('user-login');
/*----------end user login ---------*/

/*--------- coupon --------*/

Route::get('/coupon','CouponController@index')->name('coupon-view');
Route::get('/coupon-add','CouponController@create')->name('Coupon-add');
Route::post('/coupon-store','CouponController@store')->name('Coupon-store');
Route::get('/coupon-show/{id}','CouponController@show')->name('Coupon-show');
Route::get('/coupon-edit/{id}','CouponController@edit')->name('Coupon-edit');
Route::post('/coupon-update','CouponController@update')->name('Coupon-update');
Route::get('/coupon-destroy/{id}','CouponController@destroy')->name('Coupon-destroy');
Route::post('/update-coupon-status','CouponController@updateCouponStatus')->name('update-coupon-status');

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

/*---- end use ------*/

/*----- order management ------*/

Route::get('/order','OrderController@getOrder')->name('order');
Route::get('/order-detail/{id}','OrderController@getOrderDetail')->name('order-detail');


/*----- order management ------*/

/*------ report management ----*/

Route::get('/order-report','ReportController@bookingReport')->name('order');
Route::get('/payment-report','ReportController@paymentReport')->name('order-detail');
Route::get('/order-report-excel','ReportController@bookingReportExcel')->name('order-report-excel');

Route::get('/payment-report-export-excel','ReportController@paymentReportExcel')->name('payment-report-export-excel');

/*------ report management ----*/

/*-------- user management ------*/
Route::get('/user','UserController@index')->name('user');
/*-------- user management ------*/
/*---------get-user-location ------*/
Route::post('/get-user-location','UserController@getLocation')->name('get-user-location');
/*---------get-user-location ------*/
