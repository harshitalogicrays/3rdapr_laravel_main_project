<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\AOrderController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\Admin\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();



Route::prefix('/admin')->middleware(AdminMiddleware::class,'auth')->group(function(){
    Route::get('dash',[DashboardController::class,'index']);

    Route::controller(CategoryController::class)->group(function(){
        Route::prefix('category')->group(function(){
            Route::get('view','view'); 
            Route::get('add','add'); 
            Route::post('add','store');    
            Route::get('delete/{id}','delete');
            Route::get('edit/{id}','edit');
            Route::put('/update/{id}','update');
        });      
    });

    Route::controller(ProductController::class)->group(function(){
        Route::prefix('product')->group(function(){
            Route::get('view','view'); 
            Route::get('add','add'); 
            Route::post('add','store');    
            Route::get('delete/{id}','delete');
            Route::get('destroy/{id}','destroy');
            Route::get('edit/{id}','edit');
            Route::put('/update/{id}','update');
        });      
    });
    Route::controller(SliderController::class)->group(function(){
        Route::prefix('slider')->group(function(){
        Route::get('view','index');
        Route::get('create','create');
        Route::post('add','add')->name('store');
    });   
});
Route::controller(AOrderController::class)->group(function(){
    Route::prefix('orders')->group(function(){
        Route::get('/','index');
        Route::get('/view/{id}','vieworder');
        Route::put('/update/{id}','updatestatus');
        Route::get('/invoice/view/{id}','viewinvoice');
        Route::get('/invoice/download/{id}','downloadinvoice');
        Route::get('/invoice/mail/{id}','sendinvoice');
});   
});


});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(FrontendController::class)->group(function(){
    Route::get('/','index');
    Route::get('/categories/cproducts/{category?}','cproducts');
    Route::get('/categories/viewproduct/{product}','viewproduct');
    Route::get('/search','searchproduct');

});

Route::middleware('auth')->group(function(){
    Route::get('/cart',[CartController::class,'index']);
    Route::get('/checkout-show',[CartController::class,'checkout']);
    Route::get('/thank-you',[CartController::class,'thankyou']);
    Route::get('/myorders',[OrderController::class,'index']);
    Route::get('/myorders/view/{id}',[OrderController::class,'vieworder']);
    Route::get('/profile',[FrontendController::class,'profile']);
    Route::post('/saveprofile',[FrontendController::class,'saveprofile']);
    Route::get('changepassword',[FrontendController::class,'changepassword']);
    Route::post('changepassword',[FrontendController::class,'updatepassword']);
});