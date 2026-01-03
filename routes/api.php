<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\profile\PasswordController;
use App\Http\Controllers\Api\transaction\regTransactionController;
use App\Http\Controllers\Api\profile\profileController;
use App\Http\Controllers\Api\transaction\delTransactionController;
use App\Http\Controllers\Api\Books\regBookController;
use App\Http\Controllers\Api\Books\delBookController;

# Home 
Route::middleware(['auth:api'])->group(function () {
    Route::get('/profile/home', [profileController::class, 'home']);
});

# Transactions routes
Route::middleware(['auth:api'])->group(function () {
    Route::post('/transaction/create', [regTransactionController::class, 'createTransaction']);
    Route::delete('/transaction/delete', [delTransactionController::class, 'deleteTransaction']);
});



# Transactions routes
Route::middleware(['auth:api'])->group(function () {
    Route::post('/crateBook/create', [regBookController::class, 'createBook']);
    Route::delete('/Book/delete', [delBookController::class, 'deleteBook']);
});






# Auth Routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/verify_user_email', [AuthController::class, 'verifyUserEmail']);
Route::post('/auth/resend_verification_link', [AuthController::class, 'ResendEmailVerificationLink']);

# Password Routes
Route::middleware(['auth'])->group(function () {
    Route::post('change_password', [PasswordController::class, 'changePassword']);
});