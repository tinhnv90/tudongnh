<?php
$namespace = 'App\Modules\Products\Controllers';
Route::group(
    ['middleware' => ['web'], 'module'=>'Products', 'namespace' => $namespace],
    function() {
        Route::get('/danh-muc/{pathCt}','ProductsController@category');
        Route::get('/san-pham/{pathPro}','ProductsController@ProductDetail');
    }
);
?>