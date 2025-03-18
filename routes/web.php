<?php

use App\Http\Controllers\RenovationController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RenovationController::class, 'index']);
Route::post('/', [RenovationController::class, 'store'])->name('form.store');
Route::get('/report/download', [ReportController::class, 'downloadReport']);
Route::get('/report/stream', [ReportController::class, 'streamReport']);
