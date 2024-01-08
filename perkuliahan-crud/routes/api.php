<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdiController;

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


//posts
Route::apiResource('/mahasiswa', App\Http\Controllers\Api\MahasiswaController::class);
Route::apiResource('/dosen', App\Http\Controllers\Api\DosenController::class);
Route::apiResource('/matakuliah', App\Http\Controllers\Api\MatkulController::class);
Route::apiResource('/prodi', App\Http\Controllers\Api\ProdisController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
