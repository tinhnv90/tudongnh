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
    }
);
?>