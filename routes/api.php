<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('pegawai')->group(function () {
    Route::get('/', [\App\Http\Controllers\PegawaiController::class, 'index'])->name('pegawai');
    Route::post('/', [\App\Http\Controllers\PegawaiController::class, 'store'])->name('pegawai.store');
});
Route::prefix('kasbon')->group(function () {
    Route::get('/', [\App\Http\Controllers\KasbonController::class, 'index'])->name('kasbon');
    Route::post('/', [\App\Http\Controllers\KasbonController::class, 'store'])->name('kasbon.store');
    Route::patch('/setujui/{id}', [\App\Http\Controllers\KasbonController::class, 'update'])->name('kasbon.setujui');
    Route::post('/setujui-masal', [\App\Http\Controllers\KasbonController::class, 'setujuiMasal'])->name('kasbon.setujui-masal');
});
