<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\RecordController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/record/{slug}', [RecordController::class, 'show']);