<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkingSlotController;


use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\AppoinmetController;
use App\Models\Appoinmet;

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
//register user
Route::post('register', [RegisterController::class, 'register']);
//login user
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//middleware for authentication
Route::group(['middleware' => ['auth:sanctum']], function() {
    //make appoinment
    Route::post('make-appoinment',[AppoinmetController::class, 'create']);
   });
//get slot list
Route::get('get-pariking-slots',[ParkingSlotController::class,'index']);