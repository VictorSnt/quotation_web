<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\QuotationSubmissionController;
use App\Http\Controllers\QuotationSubmissionItemController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('users', [UserController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('users/{user}', [UserController::class, 'find']);
    Route::get('quotations/{id}', [QuotationController::class, 'findById']);
    Route::get('quotations', [QuotationController::class, 'findAll']);
    Route::get('current-user', [AuthController::class, 'getAuthenticatedUser']);
    Route::get('quotation-submissions', [QuotationSubmissionController::class, 'findAll']);
    Route::post('quotation-submissions', [QuotationSubmissionController::class, 'create']);
    Route::get('quotation-submission-items', [QuotationSubmissionItemController::class, 'findAll']);
    Route::post('quotation-submission-items', [QuotationSubmissionItemController::class, 'create']);
});