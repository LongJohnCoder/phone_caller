<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::any('phone/check-confirmation/{buisness_listin_id}/{directory_id}','CallconsoleController@CheckConfirm');
Route::post('callconsole/save','ApiCallConsoleController@saveAndCall');
Route::post('callconsole/savewithAudio','ApiCallConsoleController@saveAndCallWithAudio');
Route::post('callconsole/savewithaudioandtext','ApiCallConsoleController@saveAndCallWithAudioAndText');