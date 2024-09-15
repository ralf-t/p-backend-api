<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecordController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('records', [RecordController::class, 'index']);
Route::get('records/names', [RecordController::class, 'indexNames']);
Route::get('records/{name}', [RecordController::class, 'showByName']);
Route::get('records/deepest/location', [RecordController::class, 'indexByDeepestDivesByLocation']);
Route::get('records/longest/location', [RecordController::class, 'indexByLongestDivesByLocation']);
Route::post('records', [RecordController::class, 'store']);
Route::patch('records/{id}', [RecordController::class, 'update']);
Route::delete('records/{id}', [RecordController::class, 'destroy']);