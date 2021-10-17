<?php

use App\Http\Controllers\PangaeaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/subscribe/{topic:title}', [PangaeaController::class, 'subscribe'])
    ->name('subscribe')
    ->missing(function (Request $request) {
        return response()->json([
            "message" => "The given data was invalid.",
            "errors" => [
                "topic" => ["The selected topic not found."]
            ]
        ], 404);
    });

Route::post('/publish/{topic:title}', [PangaeaController::class, 'publish'])
    ->name('publish')
    ->missing(function (Request $request) {
        return response()->json([
            "message" => "The given data was invalid.",
            "errors" => [
                "topic" => ["The selected topic not found."]
            ]
        ], 404);
    });
