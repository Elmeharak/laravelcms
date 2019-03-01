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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/admin', function () {
    return view('admin.index');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('deleteGallery', 'AdminOffersController@deleteGallery');

Route::resource('admin/users', 'AdminUsersController');

Route::get('admin/categories/delete/{id}', 'AdminCategoriesController@delete');

Route::resource('admin/categories', 'AdminCategoriesController');

Route::get('admin/countries/delete/{id}', 'AdminCountriesController@delete');

Route::resource('admin/countries', 'AdminCountriesController');

Route::get('admin/governorates/delete/{id}', 'AdminGovernoratesController@delete');

Route::resource('admin/governorates', 'AdminGovernoratesController');


Route::get('GetSubCountry/{id}', 'AdminOffersController@GetSubCountry');

Route::post('deleteOfferImage', 'AdminOffersController@deleteOfferImage');

Route::post('admin/offers/madia/', 'AdminOffersController@offerImages');

Route::resource('admin/offers', 'AdminOffersController');


