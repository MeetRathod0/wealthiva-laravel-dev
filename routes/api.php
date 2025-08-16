<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Business\UserController;


Route::get('/hierarchy-json', [UserController::class, 'getHierarchyJson']);


//Route::post('/register', [AuthController::class, 'register']);
//Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/updateuserprofile', [UserController::class, 'update_user_profile']);
    // password change request
    Route::post('/generate-password-change-request', [UserController::class, 'generate_new_password']);

    Route::post('/deposite', [UserController::class, 'add_deposite_amount']);
    Route::post('/update-deposite-status', [UserController::class, 'update_deposite_status']);

    Route::post('/updateuserstatus', [UserAuthController::class, 'updateUserStatus']);
    // temporary route for first-time registration
    Route::post('/registerfirstime', [UserAuthController::class, 'registerfirstime']);

    Route::post('/update-email-phone', [UserAuthController::class, 'updateEmailPhone']);
    Route::post('/update-password', [UserAuthController::class, 'updatePassword']);
    Route::post("/getsponser", [UserAuthController::class, 'getSponserIdName']);
    Route::get('/me', [UserAuthController::class, 'me']);
    Route::post('/logout', [UserAuthController::class, 'logout']);
});