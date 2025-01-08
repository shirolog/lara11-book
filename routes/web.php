<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//ユーザーページに関する記述

Route::get('/register', [UserController::class, 'register'])
->name('user.register');
Route::post('/register', [UserController::class, 'store'])
->name('user.store');
Route::get('/login', [UserController::class, 'login'])
->name('user.login');
Route::post('/login', [UserController::class, 'authenticate'])
->name('user.authenticate');


Route::group(['middleware' => 'auth'], function(){

//homeページに関する記述
    Route::get('/', [UserController::class, 'home'])
    ->name('user.home');
    Route::post('/', [UserController::class, 'add_cart'])
    ->name('user.add_cart');

//aboutページに関する記述
    Route::get('/about', [UserController::class, 'about'])
    ->name('user.about');

//shopページに関する記述
    Route::get('/shop', [UserController::class, 'shop'])
    ->name('user.shop');

//contactページに関する記述
    Route::get('/contact', [UserController::class, 'contact'])
    ->name('user.contact');
    Route::post('/contact', [UserController::class, 'contact_store'])
    ->name('user.contact_store');

//cartページに関する記述
    Route::get('/cart', [UserController::class, 'cart'])
    ->name('user.cart');
    Route::put('/cart/{cart}', [UserController::class, 'cart_update'])
    ->name('user.cart_update');
    Route::delete('/cart/{cart}', [UserController::class, 'cart_destroy'])
    ->name('user.cart_destroy');
    Route::delete('/cart', [UserController::class, 'cart_all_destroy'])
    ->name('user.cart_all_destroy');


//checkoutページに関する記述
    Route::get('/checkout', [UserController::class, 'checkout'])
    ->name('user.checkout');
    Route::post('/checkout', [UserController::class, 'checkout_store'])
    ->name('user.checkout_store');


//ordersページに関する記述
    Route::get('/orders', [UserController::class, 'orders'])
    ->name('user.orders');

//search_pageページに関する記述
    Route::get('/search_page', [UserController::class, 'search_page'])
    ->name('user.search_page');



//logout処理に関する記述
    Route::get('/logout', [UserController::class, 'logout'])
    ->name('user.logout');


});



//管理者ページに関する記述

Route::group(['middleware' => 'admin-check'], function(){

//admin_pageに関する記述
    Route::get('/admin_page', [AdminController::class, 'admin_page'])
    ->name('admin.admin_page');



//admin_productsページに関する記述
    Route::get('/admin_products', [AdminController::class, 'admin_products'])
    ->name('admin.admin_products');
    Route::post('/admin_products', [AdminController::class, 'admin_products_store'])
    ->name('admin.admin_products_store');
    Route::delete('/admin_products/{product}', [AdminController::class, 'admin_products_delete'])
    ->name('admin.admin_products_delete');
    Route::get('/admin_products/{product}', [AdminController::class, 'admin_products_edit'])
    ->name('admin.admin_products_edit');
    Route::post('/admin_products/{product}', [AdminController::class, 'admin_products_update'])
    ->name('admin.admin_products_update');



//admin_ordersページに関する記述
    Route::get('/admin_orders', [AdminController::class, 'admin_orders'])
    ->name('admin.admin_orders');
    Route::put('/admin_orders/{order}', [AdminController::class, 'admin_orders_update'])
    ->name('admin.admin_orders_update');
    Route::delete('/admin_orders/{order}', [AdminController::class, 'admin_orders_delete'])
    ->name('admin.admin_orders_delete');


    
//admin_usersページに関する記述
    Route::get('/admin_users', [AdminController::class, 'admin_users'])
    ->name('admin.admin_users');
    Route::delete('/admin_users/{user}', [AdminController::class, 'admin_users_delete'])
    ->name('admin.admin_users_delete');


//admin_contactsページに関する記述
    Route::get('/admin_contacts', [AdminController::class, 'admin_contacts'])
    ->name('admin.admin_contacts');
    Route::delete('/admin_contacts/{message}', [AdminController::class, 'admin_contacts_delete'])
    ->name('admin.admin_contacts_delete');



//logout処理に関する記述
    Route::get('admin_logout', [AdminController::class, 'admin_logout'])
    ->name('admin.admin_logout');


    
});
