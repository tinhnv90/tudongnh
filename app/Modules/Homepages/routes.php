<?php
$namespace = 'App\Modules\Homepages\Controllers';
Route::group(
    ['middleware' => ['web'], 'module'=>'Homepages', 'namespace' => $namespace],
    function() {
        Route::get('/','HomepagesController@index');
    }
);
?>