<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hotelsController;
use App\Http\Controllers\EmailController;

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
    return 'backend working';
});


Route::get('/hotels', [hotelsController::class, 'index']);
Route::get('info/hotel/{placeID}', [hotelsController::class, 'infoHotel']);
Route::get('/hotels/zone/{zone}', [hotelsController::class, 'showHotelsZone']);
Route::get('/hotels/name/{name}', [hotelsController::class, 'hotelsByName']);
Route::get('/index', [hotelsController::class, 'index']);
Route::get('/hotels/name', [hotelsController::class, 'hotels_name']);
Route::post('/destines/pay', [HotelsController::class, 'pay_destine']);
Route::get('hotels/id/{id}', [hotelsController::class, 'hotel_id']);


// ! Routes EMail
Route::post('/send-email', [EmailController::class, 'sendEmail']);
Route::post('/send-email-rechazo/{email}', [EmailController::class, 'sendEmailRechazo']);
Route::post('/send-email-aceptar/{email}', [EmailController::class, 'sendEmailAceptar']);
