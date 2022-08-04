<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\CasterController;
use App\Http\Controllers\CreatorController;

use App\Http\Controllers\TeamController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotiController;




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

Route::get('/player/{id}', [PlayerController::class, 'show']);
Route::get('/caster/{id}', [CasterController::class, 'show']);
Route::get('/creator/{id}', [CreatorController::class, 'show']);
Route::get('/team/{id}', [TeamController::class, 'show']);
Route::get('/team', [TeamController::class, 'index']);
Route::get('/tour', [TourController::class, 'index']);
Route::get('/tour/{id}', [TourController::class, 'show']);
Route::get('/tour/filter/{name}', [TourController::class, 'showByGame']);
Route::get('/player', [PlayerController::class, 'index']);
Route::get('/caster', [CasterController::class, 'index']);
Route::get('/creator', [CreatorController::class, 'index']);


Route::get('/player/filter/{name}', [PlayerController::class, 'showByGame']);
Route::get('/caster/filter/{name}', [CasterController::class, 'showByGame']);
Route::get('/creator/filter/{name}', [CreatorController::class, 'showByGame']);


Route::get('/team/filter/{name}', [TeamController::class, 'showByGame']);
Route::get('/team/{name}/{filter}', [TeamController::class, 'showByGameFilter']);
Route::get('/player/{name}/{filter}', [PlayerController::class, 'showByGameFilter']);
Route::get('/caster/{name}/{filter}', [CasterController::class, 'showByGameFilter']);
Route::get('/creator/{name}/{filter}', [CreatorController::class, 'showByGameFilter']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/noti', [NotiController::class, 'index']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
