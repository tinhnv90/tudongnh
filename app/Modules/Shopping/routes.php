<?php
$namespace = 'App\Modules\Shopping\Controllers';
Route::group(
    ['middleware' => ['web'], 'module'=>'Shopping', 'namespace' => $namespace],
    function() {
        Route::get('/gio-hang','ShoppingCartController@cart');
        Route::get('/san-pham-ua-thich','ShoppingCartController@wishlist');
        Route::get('/so-sanh','ShoppingCartController@compare');
        Route::post('/remove-cart','ShoppingCartController@removecart');
        Route::post('/remove-compare','ShoppingCartController@removecompare');
        Route::post('/remove-wishlist','ShoppingCartController@removewishlist');
        Route::post('/dat-hang','ShoppingCartController@order');
        Route::get('thanh-toan',"ShoppingCartController@payment")
            ->middleware('authCheckLogin');
        Route::post('thanh-toan',"ShoppingCartController@post_payment")
            ->middleware('authCheckLogin');
        Route::get('shipcod',"ShoppingCartController@shipcod");
        Route::get('viettinbank',"ShoppingCartController@viettinbank");
        Route::get('techcombank',"ShoppingCartController@techcombank");
    }
);
?>