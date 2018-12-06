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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/license/indexNormal', 'LicenseController@indexNormal');
Route::get('/license/createNormal', 'LicenseController@createNormal');
Route::get('/license/updateNormal', 'LicenseController@updateNormal');
Route::get('/license/deleteNormal', 'LicenseController@deleteNormal');
Route::get('/license/indexGovernment', 'LicenseController@indexGovernment');
Route::get('/license/createGovernment', 'LicenseController@createGovernment');
Route::get('/license/updateGovernment', 'LicenseController@updateGovernment');
Route::get('/license/deleteGovernment', 'LicenseController@deleteGovernment');
Route::get('/license/indexPolice', 'LicenseController@indexPolice');
Route::get('/license/createPolice', 'LicenseController@createPolice');
Route::get('/license/updatePolice', 'LicenseController@updatePolice');
Route::get('/license/deletePolice', 'LicenseController@deletePolice');
Route::get('/license/deletePoliceAfterZeroPoint', 'LicenseController@deletePoliceAfterZeroPoint');

