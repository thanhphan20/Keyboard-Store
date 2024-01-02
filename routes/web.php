<?php

use App\CountryVisit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('admin');

// Shop and welcome
Route::get('/', 'WelcomePageController@index')->name('welcome');
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');
Route::get('/shop/search/{query}', 'ShopController@search')->name('shop.search');

// Cart
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::delete('/cart/{product}/{cart}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/save-later/{product}', 'CartController@saveLater')->name('cart.save-later');
Route::post('/cart/add-to-cart/{product}', 'CartController@addToCart')->name('cart.add-to-cart');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');

// checkout
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::get('/success', 'CheckoutController@success')->name('checkout.success');
Route::post('/cancel', 'CheckoutController@cancel')->name('checkout.cancel');   

// profile
Route::get('/profile', 'ProfileController@index')->name('profile.index');
Route::post('/profile', 'ProfileController@update')->name('profile.update');
Route::post('/profile/change-password', 'ProfileController@updatePassword')->name('profile.updatePassword');

//order
Route::get('/order/{order}', 'OrderController@show')->name('order.show'); 
    
// coupon
Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');

// auth routes
Auth::routes();
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/chart', 'VisitsController@index')->name('voyager.visits');
});