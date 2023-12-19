<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsrfTokenController;
use App\Http\Controllers\S23Controller;

Route::post('/converts23', [S23Controller::class, 'convertAndExtract']);
Route::get('/get-csrf-token', [CsrfTokenController::class, 'showCsrfToken']);