<?php
$namespace = 'App\Modules\Post\Controllers';
Route::group(
    ['middleware' => ['web'], 'module'=>'Post', 'namespace' => $namespace],
    function() {
        Route::get('/tin-tuc','PostController@category');
        Route::get('/tin-tuc/{pathPost}','PostController@PostDetail');
    }
);
?>