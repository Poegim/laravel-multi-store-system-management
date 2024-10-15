<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/get-data', [SearchController::class, 'getData'])->middleware('auth:sanctum');

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
