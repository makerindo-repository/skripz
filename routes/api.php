<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/bayar-langganan/callback/thanks', [App\Http\Controllers\Content\LanggananController::class, 'paymentCallback']);

Route::get('/jadwal', [App\Http\Controllers\Api\GeneralController::class, 'jadwal'])->name('jadwal');
Route::get('/progress', [App\Http\Controllers\Api\GeneralController::class, 'progress'])->name('progress');
Route::put('/progress/{id}', [App\Http\Controllers\Api\GeneralController::class, 'progress_update'])->name('progress_update');
