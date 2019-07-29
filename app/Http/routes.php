<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::post('/add-cart', 'BaseControllers@add_cart');
Route::post('/add-wishlist', 'BaseControllers@add_wishlist');
Route::post('/add-compare', 'BaseControllers@add_compare');
Route::get('/errorpage','BaseControllers@errorpage');
Route::get('/update-images-in-product-content','BaseControllers@imagesProduct');

Route::group(['prefix'=>'admin'],function(){
	Route::auth();
	Route::post('/choosefolder','BaseAdminController@choosefolder');
	Route::get('/webseting','BaseAdminController@get_webseting');
	Route::post('/webseting','BaseAdminController@post_webseting');
	Route::get('/', 'HomeController@infohome');
	Route::get('/dashboard','HomeController@infohome');
	Route::post('/savewarpper','HomeController@savewarpper');
	Route::post('/saveContentLeft','HomeController@saveContentLeft');
	Route::post('/saveListProduct','HomeController@saveListProduct');
	Route::post('/saveProductMain','HomeController@saveProductMain');
	Route::post('/savePostType','HomeController@savePostType');
	Route::post('/savespecialPost','HomeController@savespecialPost');
	Route::post('/post2','HomeController@savepost2');
	Route::post('/post3','HomeController@savepost3');

	Route::group(['prefix'=>'menu'],function(){
		Route::get('/','BaseAdminController@menu');
		Route::post('/delete','BaseAdminController@menudelete');
		Route::get('/add','BaseAdminController@get_menuadd');
		Route::post('/add','BaseAdminController@post_menuadd');
		Route::post('/update-showproducthome','BaseAdminController@update_showproducthome');
		Route::get('/edit-{idcategory}/{_tonken}','BaseAdminController@get_menuedit');
		Route::post('/edit-{idcategory}/{_tonken}','BaseAdminController@post_menuedit');
	});
	Route::group(['prefix'=>'product'],function(){
		Route::get('/','BaseAdminController@product');
		Route::post('/','BaseAdminController@search_product');
		Route::post('/delete','BaseAdminController@productdelete');
		Route::get('/add','BaseAdminController@get_productadd');
		Route::post('/add','BaseAdminController@post_productadd');
		Route::get('/edit-{idproduct}/{_tonken}','BaseAdminController@get_productedit');
		Route::post('/edit-{idproduct}/{_tonken}','BaseAdminController@post_productedit');
	});
	Route::group(['prefix'=>'post'],function(){
		Route::get('/','BaseAdminController@post');
		Route::post('/delete','BaseAdminController@postdelete');
		Route::get('/add','BaseAdminController@get_postadd');
		Route::post('/add','BaseAdminController@post_postadd');
		Route::get('/edit-{idproduct}/{_tonken}','BaseAdminController@get_postedit');
		Route::post('/edit-{idproduct}/{_tonken}','BaseAdminController@post_postedit');
	});
	Route::group(['prefix'=>'images'],function(){
		Route::get('/','ManageImagesController@home');
		Route::post('/updatetitlefile','ManageImagesController@updatetitlefile');
		Route::post('/copyclipboard','ManageImagesController@copyclipboard');
		Route::post('/pasteclipboard','ManageImagesController@pasteclipboard');
		Route::post('/delete','ManageImagesController@imagesdelete');
		Route::post('/uploadfie','ManageImagesController@uploadfileimg');
		Route::post('/createfolder','ManageImagesController@createfolder');
		Route::post('/createfolder-ajax','ManageImagesController@createfolderajax');
		Route::get('/{urlfolder}','ManageImagesController@homeurl');
		Route::get('/{urlfolder}/{urlfolder2}','ManageImagesController@homeurl2');
		Route::get('/{urlfolder}/{urlfolder2}/{urlfolder3}',
				'ManageImagesController@homeurl3');
		Route::get('/{urlfolder}/{urlfolder2}/{urlfolder3}/{urlfolder4}','ManageImagesController@homeurl4');
		Route::match(['get', 'post'], 'ajax-image-upload', 
				'ManageImagesController@ajaxImage');
		Route::post('/refreshfolder','BaseAdminController@listfolder');
		Route::post('/deleteimages','ManageImagesController@deleteimages');
	});
	Route::group(['prefix'=>'producer'],function(){
		Route::get('/','BaseAdminController@producer');
		Route::match(['get','post'],'/add',
				'BaseAdminController@addproducer');
		Route::match(['get','post'],'/edit/{pathproducer}',
				'BaseAdminController@editproducer');
		Route::post('/delete','BaseAdminController@deleteproducer');
	});
	Route::group(['prefix'=>'banner'],function(){
		Route::get('/','BaseAdminController@banner');
		Route::get('/li-slide','BaseAdminController@li_slide');
		Route::get('/li-service','BaseAdminController@li_service');
		Route::get('/li-custom','BaseAdminController@li_custom');
		Route::match(['get','post'],'/edit',
				'BaseAdminController@editbanner');
	});
	Route::match(['get','post'],'/introduce',
				'BaseAdminController@introduce');
	Route::group(['prefix'=>'webdesign'],function(){
		Route::match(['get','post'],'/editheader',
				'WebDesignBasis@editheader');
		Route::match(['get','post'],'/editcontent',
				'WebDesignBasis@editcontent');
		Route::match(['get','post'],'/editfooter',
				'WebDesignBasis@editfooter');
		Route::match(['get','post'],'/edithomepage',
				'WebDesignBasis@edithomepage');
		Route::get('/append-child','WebDesignBasis@append_child');
		Route::post('/insertnode','WebDesignBasis@insertnode');
		Route::post('/deletenode','WebDesignBasis@deletenode');
	});
});