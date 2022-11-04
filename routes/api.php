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

    // Public
    Route::name('login')->post('/login', [AuthApiController::class, 'login']);
    Route::name('register')->post('/register', [AuthApiController::class, 'register']);

    // Protected
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::resource('users', UserApiController::class);
        Route::resource('documents', DocumentApiController::class);
        // Example of one of several similar types of routes for CRUD on a
        // document linked to another user.
        Route::get('/users/{user}/documents/{document}', function(User $user, Document $document) {
            return $document;
        })->scopeBindings();
        Route::name('logout')->post('/logout', [AuthApiController::class, 'logout']);
    });
});
