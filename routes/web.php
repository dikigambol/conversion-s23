<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsrfTokenController;
use App\Http\Controllers\S23Controller;

Route::post('/converts-extract', [S23Controller::class, 'convertAndExtract']);
Route::post('/converts-zip', [S23Controller::class, 'convertS23toZip']);
Route::post('/extracts23', [S23Controller::class, 'extractS23']);
Route::post('/create-zip-s23', [S23Controller::class, 'createZipS23']);
Route::post('/unzip', [S23Controller::class, 'unZipFiles']);
Route::get('/get-csrf-token', [CsrfTokenController::class, 'showCsrfToken']);