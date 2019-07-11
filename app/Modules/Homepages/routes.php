<?php
$namespace = 'App\Modules\Homepages\Controllers';
Route::group(
    ['module'=>'Homepages', 'namespace' => $namespace],
    function() {
        Route::get('/','HomepagesController@index');
    }
);
?>