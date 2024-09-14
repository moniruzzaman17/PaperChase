<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Settings\SubjectController;
use App\Http\Controllers\Api\V1\Settings\TopicController;
use App\Http\Controllers\Api\V1\Settings\SubTopicController;
use App\Http\Controllers\Api\V1\Settings\FindingController;
use App\Http\Controllers\Api\V1\Settings\ExplanationController;
use App\Http\Controllers\Api\V1\Auth\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);

        // Other routes that need to be protected
        Route::apiResource('subjects', SubjectController::class);
        Route::apiResource('topics', TopicController::class);
        Route::apiResource('sub-topics', SubTopicController::class);
        Route::apiResource('findings', FindingController::class);
        Route::apiResource('explanations', ExplanationController::class);
    });
});
