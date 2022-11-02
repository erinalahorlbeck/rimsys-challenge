<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\AuthApiController;
use App\Http\Controllers\Api\V1\UserApiController;
use App\Http\Controllers\Api\V1\DocumentApiController;

use App\Models\User;
use App\Models\Document;

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


Route::prefix('v1')->group(function() {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Route::post('/login', [AuthApiController::class, 'login']);

    Route::resource('users', UserApiController::class);

    Route::resource('documents', DocumentApiController::class);

    Route::get('/users/{user}/documents/{document}', function(User $user, Document $document) {
        return $document;
    })->scopeBindings();
});
