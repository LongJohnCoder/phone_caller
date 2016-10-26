<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','UserController@index');

Route::post('user/signin', 'UserController@userSignin');
Route::any('dashboard', 'DashboardController@index');
Route::get('directory/list', 'DirectoryController@ListsDirect');
Route::get('directory/add', 'DirectoryController@Add');
Route::Post('directory/save', 'DirectoryController@Save');
Route::get('directory/{directory}','DirectoryController@BuisnessList');
Route::get('directory/uploadxml/{directory}','DirectoryController@UploadXml');
Route::Post('directory/savexml','DirectoryController@saveXml');
Route::get('readNstore','DirectoryController@readNstore');
Route::get('directory/calllist/{directory}','DirectoryController@callList');
Route::get('callconsole/add_call','CallconsoleController@addcall');
Route::post('callstack/save','CallconsoleController@saveexces');
Route::get('callconsole/testcall/{directory}','DirectoryController@readNCall');
Route::get('start-calling/{directory}','DirectoryController@readNCall');
Route::any('phone/check-confirmation/{buisness_listin_id}','CallconsoleController@CheckConfirm');