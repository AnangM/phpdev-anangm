<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Candidate\CandidateController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware'=>['auth:api']], function(){
    Route::group(['prefix'=>'candidates'], function(){
        Route::get('', [CandidateController::class, 'list']);
        Route::post('', [CandidateController::class, 'create']);
        Route::get('/{id}', [CandidateController::class, 'read']);
        Route::put('/{id}', [CandidateController::class, 'update']);
    });        
});
