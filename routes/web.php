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

Route::get('/', 'SiteController@index');
Route::get('/login', 'UserAuthController@login');
Route::post('/login/post', 'UserAuthController@login_post');
Route::get('/register', 'UserAuthController@register');
Route::post('/register/post', 'UserAuthController@register_post');
Route::get('/logout', 'UserAuthController@logout');


Route::get('/product/detail/{id}', 'SiteController@product_detail');
Route::post('/add_cart/{id}', 'CartController@addCart');
Route::get('/cart', 'CartController@cart');
Route::get('/cart/plus/{id}', 'CartController@plus_cart');
Route::get('/cart/minus/{id}', 'CartController@minus_cart');
Route::get('/cart/delete/{id}', 'CartController@cart_delete');
Route::get('/checkout/payment', 'CheckoutController@payment')->name('checkout_payment');
Route::post('/checkout/add_address', 'CheckoutController@add_address');
Route::get('/checkout_delete_session', 'CheckoutController@delete_session');

Route::group(
    [
        'prefix' => 'admin'
    ],
    function() {
        Route::get('login', 'AuthController@index')
            ->name('login');
        Route::post('postlogin', 'AuthController@postlogin');
        Route::get('logout', 'AuthController@logout');
        Route::group(
            [
                'middleware' => ['auth', 'checkRole']
            ],
            function() {
                Route::group(
                    [
                        'prefix' => 'dashboard'
                    ],
                    function() {
                        Route::get('', 'DashboardController@index')
                            ->name('admin.dashboard');
                    }
                );
                Route::group(
                    [
                        'prefix' => 'product'
                    ],
                    function(){
                        Route::get('', 'ProductsController@index')
                            ->name('admin.product');
                        Route::get('create', 'ProductsController@create')
                            ->name('admin.product.create');
                        Route::post('store', 'ProductsController@store')
                            ->name('admin.product.store');
                        Route::get('edit/{id}', 'ProductsController@edit')
                            ->name('admin.product.edit');
                        Route::post('update/{id}', 'ProductsController@update');
                        Route::get('delete/{id}', 'ProductsController@delete')
                            ->name('admin.product.delete');
                        Route::get('view/{id}', 'ProductsController@view')
                            ->name('admin.product.view');
                        Route::get('print_pdf', 'ProductsController@print_pdf');
                        Route::get('data', 'ProductsController@data')
                            ->name('admin.product.data');
                    }
                );
                Route::group(
                    [
                        'prefix' => 'brand'
                    ],
                    function(){
                        Route::get('', 'BrandsController@index')
                            ->name('admin.brand');
                        Route::post('create', 'BrandsController@create');
                        Route::get('edit/{id}', 'BrandsController@edit');
                        Route::post('update/{id}', 'BrandsController@update');
                        Route::get('delete/{id}', 'BrandsController@delete');
                    }
                );
                Route::group(
                    [
                        'prefix' => 'category'
                    ],
                    function(){
                        Route::get('', 'CategoriesController@index')
                            ->name('admin.category');
                        Route::post('create', 'CategoriesController@create');
                        Route::post('edit/{id}', 'CategoriesController@edit');
                        Route::get('delete/{id}', 'CategoriesController@delete');
                    }
                );
                Route::group(
                    [
                        'prefix' => 'customer'
                    ],
                    function(){
                        Route::get('', 'CustomerController@index')
                            ->name('admin.customer');
                        Route::post('create', 'CustomerController@create');
                        Route::get('edit/{id}', 'CustomerController@edit');
                        Route::get('delete/{id}', 'CustomerController@delete');
                        Route::post('update/{id}', 'CustomerController@update');
                        Route::get('profile/{id}', 'CustomerController@profile');
                    }
                );
            }
        );
    }
);
