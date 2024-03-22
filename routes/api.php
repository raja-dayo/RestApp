<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
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

// Route::middleware('auth.session')->get('/example', function () {
//     return response()->json(['message' => 'Authenticated']);
// });

// Route::resource('v1/movies', \App\Http\Controllers\MovieController::class);

Route::middleware('auth.session')->group(function () {
    Route::resource('v1/movies', MovieController::class);
});