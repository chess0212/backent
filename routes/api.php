<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;

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
Route::post('/register',[UserController::class,"register"]);
Route::match (['get', 'post'],'/login',[UserController::class,"login"]);

Route::get('/questions', [QuestionController::class, 'index']);
Route::get('/response/user/{session_id}', [QuestionController::class, 'getResponses']);
// Route::post('/questions/{questionId}/responses', [QuestionController::class, 'store']);
Route::match (['get', 'post'],'/questions/responses',[  QuestionController::class,"store" ]);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('trusttoken')->group(function(){

    Route::get('/logout/{id}/{token}',[UserController::class, "logout"]);
    Route::get('/session/{token}',[QuestionController::class, "getSession"]);
    Route::get('/response/{token}', [QuestionController::class, 'getResponse']);

});
