<?php
	$namespace="App\Modules\User\Controllers";
	Route::group(
		["middleware"=>["web"],"module"=>"User","namespace"=>$namespace],
		function(){
			Route::get('dang-nhap',"UserController@login")
				->middleware('authCheckLogin')->name('frmlogin');
			Route::post('dang-nhap',"UserController@post_login");

			Route::get('dang-ky',"UserController@register")
				->middleware('authCheckLogin')->name('frmlogin');
			Route::post('dang-ky',"UserController@post_register");

			Route::get('dang-xuat',"UserController@logout");
			Route::get('quen-mat-khau',"UserController@forgotPassword");

			Route::get('tai-khoan',"UserController@myAccount")
				->middleware('authCheckLogin');
			Route::get('lich-su-giao-dich',"UserController@transactionhistory")
				->middleware('authCheckLogin');
		}
	);
?>