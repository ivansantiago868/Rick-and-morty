<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\GenderController;

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
Route::get('/persons', [PersonController::class, 'index']);
Route::post('/person', [PersonController::class, 'store']);
Route::get('/person', [PersonController::class, 'show']);
Route::get('/person/{person}/edit', [PersonController::class, 'edit']);
Route::put('/person/{person}', [PersonController::class, 'update']);
Route::delete('/person/{person}', [PersonController::class, 'destroy']);

Route::get('/genders', [GenderController::class, 'index']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
