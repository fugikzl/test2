<?php

use App\Http\Controllers\ContainerApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationApiController;
use App\Http\Controllers\OrderApiController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/location', [LocationApiController::class, 'index']);
Route::get('/container/{id}', [ContainerApiController::class, 'index']);
Route::get('/order/calculate', [OrderApiController::class, 'calculate']);

Route::post('/order', [OrderApiController::class, 'create']);