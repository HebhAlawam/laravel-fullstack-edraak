<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;




Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/', function () { return view('welcome'); });


Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'loginAdmin'])->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => ['auth','isAdmin']], function(){    
    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');

    Route::resource('/category',CategoryController::class);


    Route::resource('/subCategory',SubCategoryController::class);
    Route::controller(SubCategoryController::class)->prefix('subCategory')->group(function () {  
        Route::get('/soft/delete/{id}', 'softdelete')->name('subCategory.softdelete');
        Route::get('/trash/all', 'trash')->name('subCategory.trash');
        Route::get('/back/from/trash/{id}', 'backFromTrash')->name('subCategory.back');
        Route::delete('/hard/delete/{id}', 'hardDelete')->name('subCategory.hardDelete');
        Route::post('subcat', 'subCat')->name('subcat');
    });


    Route::resource('/product',ProductController::class);
    Route::controller(ProductController::class)->prefix('product')->group(function () {
        Route::delete('/soft/delete/{id}', 'delete')->name('product.softdelete');
        Route::get('/trash/all', 'trash')->name('product.trash');
        Route::get('/back/from/trash/{id}', 'backFromTrash')->name('product.back');
        Route::delete('/hard/delete/{id}', 'hardDelete')->name('product.hardDelete');
    });

    Route::controller(OrderController::class)->prefix('order')->group(function () {
        Route::get('/all', 'allOrder')->name('order.index');
        Route::get('/details/{id}', 'orderDetails')->name('order.details');
        Route::post('status', 'status')->name('order.status');
    });

    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/all', 'users')->name('all.user');
        Route::get('/status/update', 'updateStatus')->name('user.update.status');


    });

});

Route::controller(FrontendController::class)->group(function () { 
    Route::get('/','index')->name('frontend');
    Route::post('/filter','index')->name('frontend.filter');
    Route::get('advance/filter', 'advanceFilter')->name('advance.filter');
    Route::get('/filster/category/{cat}','filterByCat')->name('product.filter');
    Route::get('/product/detail/{id}','productDetail')->name('product.detail');
});


Route::group(['middleware' => ['auth']], function(){    

    Route::controller(CartController::class)->group(function () { 
        Route::get('/product-in-cart', 'itemsInCart')->name('product.in.cart');
        Route::get('/addd-to-cart', 'addToCart')->name('add.to.cart');
        Route::get('/update-quantity', 'updateQuantity')->name('update.quantity');

        Route::get('/remove-from-cart', 'removeFromCart')->name('remove.from.cart');
        Route::get('/remove/{id}', 'removeCart')->name('remove.cart');
    });

    Route::controller(OrderController::class)->group(function () { 
        Route::get('checkout/page', 'checkoutPage')->name('checkout.page');
        Route::get('/orders', 'customerOrder')->name('customer.order');
        Route::get('/order/details/{id}', 'orderDetails')->name('user.order.details');
        Route::get('/order/view/{id}', 'orderView')->name('admin.order.view');


        Route::post('/checkout/store','checkout')->name('checkout.store');

        Route::get('/test','test');

    });

});
        




