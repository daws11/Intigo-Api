<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\CreatorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('meetings', MeetingController::class);
Route::apiResource('creators', CreatorController::class);
Route::post('/create-creator-route', 'CreatorController@store');
Route::put('/update-creator-route/{id}', 'CreatorController@update');
Route::post('/create-meeting-route', 'MeetingController@store');
Route::put('/update-creator-route/{id}', 'MeetingController@update');
