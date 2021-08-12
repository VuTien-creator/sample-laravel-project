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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/',function (){
    return redirect('campaign');
});
Route::resource('campaign', 'CampaignController');
Route::get('logout','Auth\LoginController@logout')->name('out');

Route::prefix('{campaign}')->group(function(){
    Route::resource('ticket', 'TicketController');
    Route::resource('place', 'PlaceController');
    Route::resource('area', 'AreaController');
    Route::resource('session', 'SessionController');
});

