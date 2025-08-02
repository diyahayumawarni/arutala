<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ✅ Tambahkan ini agar endpoint /api/rooms aktif
Route::apiResource('rooms', RoomController::class);
