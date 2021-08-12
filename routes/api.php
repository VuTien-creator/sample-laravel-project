<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('v1')->group(function(){
    Route::get('campaigns','ApiController@b1Read');
    Route::get('organizers/{organizerSlug}/campaigns/{campaignSlug}','ApiController@b2Read');
    Route::post('login','ApiController@b3Login');
    Route::post('logout','ApiController@b3Logout');
    Route::post('organizers/{organizerSlug}/campaigns/{campaignSlug}/registration','ApiController@b4New');
    Route::get('registrations','ApiController@b4Get');
});
