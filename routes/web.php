<?php

use App\Http\Controllers\RenovationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RenovationController::class, 'index']);
Route::post('/', [RenovationController::class, 'store'])->name('form.store');
Route::get('/test/pdf', [RenovationController::class, 'pdf']);
Route::get('/test/web', [RenovationController::class, 'web']);
