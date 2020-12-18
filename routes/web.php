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
//Frontend
Route::get('/','HomeController@index' );
Route::get('/Home','HomeController@index');
Route::get('/show_category/{category_ID}','HomeController@show_category');
Route::get('/show_supplier/{supplire_ID}','HomeController@show_supplier');
Route::get('/detail/{product_ID}','HomeController@detail');
//Seach

// Route::post('/search_PR','HomeController@search_PR');
//Route::post('/search_PR','HomeController@search_PR');
// Route::request('/search_PR','HomeController@search_PR');
//Route::match(['get', 'post'], '/search_PR','HomeController@search_PR');
Route::get('/search/{searchStr}','HomeController@search');

//Backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/logout','AdminController@logoutdashboard');

//Category Product
Route::get('/add_category_product','CategoryController@add_category_product');
Route::get('/all_category_product','CategoryController@all_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryController@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryController@delete_category_product');

Route::post('/save_category_product','CategoryController@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryController@update_category_product');

	//SupplierController Product
Route::get('/add_supplier','SupplierController@add_supplier');
Route::get('/all_supplier','SupplierController@all_supplier');

Route::get('/edit-supplier/{supplier_id}','SupplierController@edit_supplier');
Route::get('/delete-supplier/{supplier_id}','SupplierController@delete_supplier');

Route::post('/save_supplier','SupplierController@save_supplier');
Route::post('/update-supplier/{supplier_id}','SupplierController@update_supplier');
 //Product
Route::get('/add_product','ProductController@add_product');
Route::get('/all_product','ProductController@all_product');


Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save_product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');

//cart
Route::post('/addcart/{productID}','CartController@add_cart');
Route::get('/addcart-home/{productID}','CartController@add_cart_home');
Route::get('/show-cart','CartController@Show_cart');
Route::get('/delcart/{productID}', 'CartController@del_cart');
Route::post('/update_cart', 'CartController@update_cart');
//Customer 
Route::get('/logincus', 'CustomerController@logincus');
Route::post('/checklogin', 'CustomerController@checklogin');
Route::get('/logoutcus', 'CustomerController@logoutcus');
Route::post('/add_cus','CustomerController@add_cus');
// Route::get('/getinfo-facebook','CustomerController@getinfo_facebook');
// Route::get('/checkinfo-facebook', 'CustomerController@checkinfo_facebook');

Route::get('login/facebook', 'CustomerController@redirectToProvider');
Route::get('login/facebook/callback', 'CustomerController@handleProviderCallback');
//checkout
Route::get('/checkout','CheckoutController@checkout');
Route::get('/order','CheckoutController@order');
Route::post('/confirmOrder','CheckoutController@confirmOrder');
Route::post('/confirm-order','CheckoutController@confirm_order');
//Order
Route::get('/all_order','OrderController@all_order');
Route::get('/active_order/{orderID}','OrderController@active_order');
Route::get('/order_detail/{orderID}','OrderController@order_detail');