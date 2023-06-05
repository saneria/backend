<?php

use App\Http\Controllers\Api\AIController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarouselItemsController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PromptsController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//public API's
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/user',  [UserController::class, 'store'])->name('user.store');

// prompts API
Route::post('/prompts',[PromptsController::class, 'store']);


//OCR API
Route::post('/ocr', [AIController::class, 'ocr'])->name('ocr.image '); 

    
//private API's
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout',[ AuthController::class, 'logout']);

    Route::get('/prompts',[PromptsController::class, 'index']);
    Route::delete('/prompts/{id}',[PromptsController::class, 'destroy']);
    Route::delete('/prompts',[PromptsController::class, 'clear']);

//admin API's
    Route::controller(CarouselItemsController::class)->group(function () {
        Route::get('/carousel',             'index');
        Route::get('/carousel/{id}',        'show');
        Route::post('/carousel',            'store');
        Route::put('/carousel/{id}',        'update');
        Route::delete('/carousel/{id}',     'destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user',                 'index');
        Route::get('/user/{id}',            'show');
        Route::put('/user/{id}',            'update')->name('user.update');
        Route::put('/user/email/{id}',      'email')->name('user.email');
        Route::put('/user/password/{id}',   'password')->name('user.password');
        Route::put('/user/image/{id}',      'image')->name('user.image');
        Route::delete('/user/{id}',         'destroy'); 
    });

    //user specific API's
    Route::get('/profile/show',         [ProfileController::class, 'show']); //based sa token
    Route::put('/profile/image',        [ProfileController::class, 'image'])->name('profile.image'); //based sa token

});

/*Route::get('/messages', [MessagesController::class, 'index']);
Route::post('/messages', [MessagesController::class, 'store']);
Route::put('/messages/{id}', [MessagesController::class, 'update']); */
