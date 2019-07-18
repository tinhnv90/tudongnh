<?php
$namespace = 'App\Modules\Products\Controllers';
Route::group(
    ['middleware' => ['web'], 'module'=>'Products', 'namespace' => $namespace],
    function() {
        Route::get('/san-pham/{pathPro}','ProductsController@detailProduct');
    }
);
?>