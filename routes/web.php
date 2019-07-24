<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('admin.index');
});

Route::group(['prefix' => 'admin','as' => 'admin.','namespace' => 'Admin'], function () {

	Route::resource('/country', 'CountryController');
	Route::post('/country/reload', 'CountryController@reload');

	Route::resource('city', 'CityController');
	Route::post('/city/reload', 'CityController@reload');
		// Vendor routes
	Route::resource('vendor', 'VendorController');
	//ajax request for getting country cities
	Route::POST('vendor/getCities', 'VendorController@getCities');
	//PDF generator for vendor details
	Route::get('vendor/generate_pdf/{id}', 'VendorController@generatePDF')->name('vendor.generate_pdf');
	// Curtomer routes
	Route::resource('customer','CustomerController');
	Route::post('customer/search','CustomerController@search');
		//ajax request for getting country cities
	Route::POST('customer/getCities', 'CustomerController@getCities');

		// ItemCategory routes
	Route::resource('item_category','ItemCategoryController');
			// Item Category
	Route::resource('item','ItemController');
		Route::post('/item/reload', 'ItemController@reload');
		Route::post('/item/edit', 'ItemController@edit');
		// Warehouse Routes
	Route::resource('warehouse','WarehouseController');

	Route::POST('warehouse/getCities', 'WarehouseController@getCities');
 });

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
