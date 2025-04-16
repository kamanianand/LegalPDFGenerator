<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfGeneratorController;

Route::get('/', function () {
    return view('welcome');
});

// generate pdf route
Route::get('/generate-pdf', [PdfGeneratorController::class, 'index']);
