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

//All Frontend Route


Route::get('/','Frontend\FrontendController@index');
Route::get('category','Frontend\FrontendController@category');
Route::get('category/{slug}','Frontend\FrontendController@view_category');
Route::get('category/{cate_slug}/{prod_slug}','Frontend\FrontendController@view_product');
Route::post('/add-to-cart','Frontend\CartController@addProduct');
                                
Route::middleware('auth')->group(function() {
    Route::get('/cart','Frontend\CartController@viewCart')->name('cart');
    Route::post('/delete-cart-item','Frontend\CartController@deleteCartItem');
    Route::post('/update-cart','Frontend\CartController@updateCart');
    Route::get('/checkout','Frontend\CheckoutController@index');
    Route::post('/place-order','Frontend\CheckoutController@placeOrder');
    Route::get('/my-orders','Frontend\UserController@index');
    Route::get('/view-order/{order_id}','Frontend\UserController@view_order');
    Route::get('/wishlist','Frontend\WishlistController@index');
    Route::post('/add-to-wishlist','Frontend\WishlistController@add_to_wishlist');
    Route::post('/delete-wishlist-item','Frontend\WishlistController@delete_wishlist_item');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// All Admin Panel Route

Route::middleware(['auth','isAdmin'])->group(function () {

    Route::get('/dashboard','Admin\DashboardController@index');

    
    Route::prefix('categories')->name('category')->group(function(){
        Route::get('','Admin\CategoryController@index')->name('');
         Route::get('insert_form','Admin\CategoryController@insert_form')->name('.read'); 
         Route::post('insert','Admin\CategoryController@insert')->name('.insert'); 
         Route::get('edit/{id}','Admin\CategoryController@edit')->name('.edit'); 
         Route::post('update/{id}','Admin\CategoryController@update')->name('.update'); 
         Route::get('delete/{id}','Admin\CategoryController@delete')->name('.delete'); 
                                      });
    
    Route::prefix('products')->name('product')->group(function(){
        Route::get('','Admin\ProductController@index')->name('');
         Route::get('insert_form','Admin\ProductController@insert_form')->name('.read'); 
         Route::post('insert','Admin\ProductController@insert')->name('.insert'); 
         Route::get('edit/{id}','Admin\ProductController@edit')->name('.edit'); 
         Route::post('update/{id}','Admin\ProductController@update')->name('.update'); 
         Route::get('delete/{id}','Admin\ProductController@delete')->name('.delete'); 
                                      });


        Route::get('/orders','Admin\OrderController@index');  
        Route::get('/admin/view-order/{order_id}','Admin\OrderController@view_order');                               
        Route::put('/update-order/{order_id}','Admin\OrderController@update_order');                               
        Route::get('/order-history','Admin\OrderController@order_history');    
        Route::get('/users','Admin\UserController@index');
        Route::get('/view-user/{user_id}','Admin\UserController@view_user');                           
  });
