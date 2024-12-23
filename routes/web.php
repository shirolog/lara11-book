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

    Route::get('/', [UserController::class, 'home'])
    ->name('user.home');
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
    Route::put('/admin_products/{product}', [AdminController::class, 'admin_products_update'])
    ->name('admin.admin_products_update');


//admin_ordersページに関する記述
    Route::get('/admin_orders', [AdminController::class, 'admin_orders'])
    ->name('admin.admin_orders');


    
//admin_usersページに関する記述
    Route::get('/admin_users', [AdminController::class, 'admin_users'])
    ->name('admin.admin_users');


//admin_contactsページに関する記述
    Route::get('/admin_contacts', [AdminController::class, 'admin_contacts'])
    ->name('admin.admin_contacts');





//logout処理に関する記述
    Route::get('admin_logout', [AdminController::class, 'admin_logout'])
    ->name('admin.admin_logout');


    
});
