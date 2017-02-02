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


Route::get('/', 'SiteController@index');
Route::auth();
Route::group(['middleware' => 'auth','prefix'=>'admin','namespace' => 'Admin'], function () {
  	Route::get('backend', 'HomeController@index');
	Route::resource('/category','CategoryController');
	Route::post('/category/changeStatus', 'CategoryController@changeStatus');
	Route::get('category/destroy/{id}','CategoryController@destroy');

	Route::resource('/news','NewsController');
	Route::post('/news/changeStatus', 'NewsController@changeStatus');
	Route::get('news/destroy/{id}','NewsController@destroy');

	Route::resource('/sliders','SlidersController');
	Route::post('/sliders/changeStatus', 'SlidersController@changeStatus');
	Route::get('sliders/destroy/{id}','SlidersController@destroy');

	Route::resource('/gallery','GalleryController');
	Route::post('/gallery/changeStatus', 'GalleryController@changeStatus');
	Route::get('gallery/destroy/{id}','GalleryController@destroy');

	Route::resource('/Ads','AdsController');
	Route::post('/Ads/changeStatus', 'AdsController@changeStatus');
	Route::get('Ads/destroy/{id}','AdsController@destroy');
});


Route::get('story/{id}/{title}','StoryController@detailes');
Route::get('section/{id}/{title}','StoryController@category');
