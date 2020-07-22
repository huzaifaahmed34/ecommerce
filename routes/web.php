<?php

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



	// Route::get('LoginUser', 'User\Account@index');

	// Route::post('LoginUser', ['as'=>'admin-login','uses'=>'Auth\AdminLoginController@login']);

Route::get('/AdminLogout', 'Auth\AdminLoginController@logout' );
Route::get('/Vue',function(){
	return view('User/VuePractice');
});

Route::post('paypal','User\Home@Paypal')->name('checkout.paypal');
Route::get('returnPaypal','User\Home@requestPaypal')->name('process.paypal');
Route::get('cancelPaypal','User\Home@cancelPaypal')->name('cancel.paypal');
Route::get('payment',function(){
return view('Payment');
});


Route::get('/','User\Home@index');

Route::get('/home','User\Home@index');
Route::get('/CategoriesSearch/{slug}','User\Home@CategoriesSearch');
Route::get('/SubCategoriesSearch/{slug}','User\Home@SubCategoriesSearch');
Route::get('/ProductDetail/{slug}','User\Home@ProductDetail');


Route::get('/getFilter','User\Home@getFilter');

Route::get('/getFilterSearch','User\Home@getFilterSearch');


Route::get('/Featured','User\Home@Featured');




Route::get('/CustomerLogin','Auth\AdminLoginController@showLoginForm');
Route::post('CustomerLogin','Auth\AdminLoginController@login');
Route::post('/Adminlogout','Auth\AdminLoginController@logout');





Route::group( [ 'prefix' => '' ,'middleware'=>['auth:customer']], function()
{	

Route::post('/paywithpaypal','PaymentController@paywithpaypal');
Route::get('/Cart','User\Home@Cart');

Route::get('/paywithpaypal',function(){
	return view('Home/Paypal');
});
Route::get('/Status',function(){
	return view('Home/Status');
});

Route::get('/ShowProductCart','User\Home@ShowProductCart');
Route::post('/AddCart','User\Home@AddCart');
Route::get('/SizeChange','User\Home@SizeChange');
Route::get('/CartDelete','User\Home@CartDelete');
Route::get('/QuantityUp','User\Home@QuantityUp');
Route::get('/QuantityDown','User\Home@QuantityDown');
Route::get('/Profile','User\Home@Profile');
Route::get('/Order','User\Home@Order');

Route::get('/ShowOrderDetails','User\Home@ShowOrderDetails');
Route::post('/InsertOrder','User\Home@InsertOrder');
Route::post('/UpdateProfilePic','User\Home@UpdateProfilePic');

Route::post('/UpdatePassword','User\Account@UpdatePassword');
Route::post('/updateCustomer','User\Account@UpdateCustomer');


});

Route::get('/Search','User\Home@Search')->name('search');

Route::get('/Search/{slug}','User\Home@SearchResults');



Route::post('/SubmitRating','User\Home@SubmitRating');

Route::get('/ViewComments/{id}','User\Home@ViewComments');

Route::get('/AccessForbidden','User\Home@AccessForbidden');


Route::post('/InsertSignup','User\Account@InsertSignup');

Route::get('/CheckVerificationCode','User\Account@CheckVerificationCode');


Route::group( [ 'prefix' => 'admin' ,'middleware'=>['auth:web']], function()
{	 Route::get('/','Admin\Dashboard@index');
    Route::get('/CategoryAdd','Admin\Category@AddCategory');
Route::post('/InsertCategory','Admin\Category@InsertCategory');
Route::get('/CategoryView','Admin\Category@ViewCategory');
Route::get('/CategoryShow','Admin\Category@ShowCategory');


 Route::get('/SpecificationAdd','Admin\Product@AddSpecification');
Route::post('/InsertSpecification','Admin\Product@InsertSpecification');

Route::post('/InsertWarrantyType','Admin\Product@InsertWarrantyType');

 Route::get('/addWarrantyType','Admin\Product@addWarrantyType');

 Route::post('/InsertWarranty','Admin\Product@InsertWarranty');

 Route::get('/addWarranty','Admin\Product@addWarranty');

 Route::get('/GetBrand','Admin\Product@GetBrand');
 Route::get('/GetSubcategory','Admin\Product@GetSubcategory');
 Route::get('/BrandAdd','Admin\Product@AddBrand');
Route::post('/InsertBrand','Admin\Product@InsertBrand');

Route::get('/ProductDiscount','Admin\Product@ProductDiscount');
Route::get('/ViewCancelOrders','Admin\Order@ViewCancelOrders');

Route::get('/ViewCompletedOrders','Admin\Order@ViewCompletedOrders');
Route::get('/ViewPendingOrders','Admin\Order@ViewPendingOrders');
Route::get('/PendingOrderShow','Admin\Order@PendingOrderShow');

Route::get('/PendingOrderDetailsShow/{id}','Admin\Order@PendingOrderDetailsShow');
Route::get('/ConfirmOrder/{id}','Admin\Order@ConfirmOrder');

Route::get('/CancelOrder/{id}','Admin\Order@CancelOrder');

Route::get('/CompletedOrderShow','Admin\Order@CompletedOrderShow');

Route::get('/CompletedOrderDetailsShow/{id}','Admin\Order@CompletedOrderDetailsShow');


Route::get('/CancelOrderShow','Admin\Order@CancelOrderShow');

Route::get('/CancelOrderDetailsShow/{id}','Admin\Order@CancelOrderDetailsShow');





Route::get('/CategoryEdit/{id}','Admin\Category@EditCategory');
Route::get('/CategoryDelete/{id}','Admin\Category@DeleteCategory');
Route::post('/CategoryUpdate','Admin\Category@UpdateCategory');




    Route::get('/SubCategoryAdd','Admin\Subcategory@AddSubCategory');
Route::post('/InsertSubCategory','Admin\Subcategory@InsertSubCategory');
Route::get('/SubCategoryView','Admin\Subcategory@ViewSubCategory');
Route::get('/SubCategoryShow','Admin\Subcategory@ShowSubCategory');


Route::get('/SubCategoryEdit/{id}','Admin\Subcategory@EditSubCategory');
Route::get('/SubCategoryDelete/{id}','Admin\Subcategory@DeleteSubCategory');
Route::post('/SubCategoryUpdate','Admin\Subcategory@UpdateSubCategory');






    Route::get('/DealerAdd','Admin\Dealer@AddDealer');
Route::post('/InsertDealer','Admin\Dealer@InsertDealer');
Route::get('/DealerView','Admin\Dealer@ViewDealer');
Route::get('/DealerShow','Admin\Dealer@ShowDealer');


Route::get('/DealerEdit/{id}','Admin\Dealer@EditDealer');
Route::get('/DealerDelete/{id}','Admin\Dealer@DeleteDealer');
Route::post('/DealerUpdate','Admin\Dealer@UpdateDealer');




 Route::get('/ProductAdd','Admin\Product@AddProduct');
Route::post('/InsertProduct','Admin\Product@InsertProduct');
Route::get('/ProductView','Admin\Product@ViewProduct');
Route::get('/ProductShow','Admin\Product@ShowProduct');
Route::get('/UpdateDiscount','Admin\Product@UpdateDiscount');
Route::get('/UpdateDiscountAll','Admin\Product@UpdateDiscountAll');
Route::get('/RemoveDiscountAll','Admin\Product@RemoveDiscountAll');

Route::get('/ProductEdit/{id}','Admin\Product@EditProduct');
Route::get('/ProductDelete/{id}','Admin\Product@DeleteProduct');
Route::post('/ProductUpdate','Admin\Product@UpdateProduct');

});



 
Auth::routes();


?>