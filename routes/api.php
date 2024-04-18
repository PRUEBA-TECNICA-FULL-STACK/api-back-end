<?php

use App\Http\Controllers\api\MovieController;
use App\Http\Controllers\api\RatingController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware('auth:api')->group(function () {
    Route::get('v1/user', [UserController::class, 'show'])
        ->name('user.show');
});

Route::middleware(['auth:api', 'verified'])->group(function () {
    Route::patch('v1/user', [UserController::class, 'update'])
        ->name('user.update');

    Route::patch('v1/user/change-password', [UserController::class, 'changePassword'])
        ->name('user.change-password');
});

Route::get('v1/movies', [MovieController::class, 'index']);
Route::post('v1/movies', [MovieController::class, 'store']);

Route::get('v1/ratings', [RatingController::class, 'index']);
Route::post('v1/ratings', [RatingController::class, 'store']);
