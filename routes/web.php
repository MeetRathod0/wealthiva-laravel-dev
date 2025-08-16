<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Routes\AdminViewController;
use App\Http\Controllers\MailController;

Route::get('/', [AdminViewController::class, 'admin_login']);
Route::get('/login', [AdminViewController::class, 'admin_login'])->name('login');
Route::get('/register/{id}', [AdminViewController::class, 'admin_register']);
//Route::get('/register', [AdminViewController::class, 'admin_register2']);
//Route::get('/send-mail', [MailController::class, 'index']);

// Admin routes
Route::middleware(['web', 'auth', 'role:1,2,3'])->group(function () {
    Route::get('/admin/requests', [AdminViewController::class, 'admin_requests']);
    Route::get('/temp-register', [AdminViewController::class, 'admin_tempregister']);
    Route::get('/admin/home', [AdminViewController::class, 'admin_home']);
    Route::get('/admin/users', [AdminViewController::class, 'admin_usermanager']);
    Route::get('/admin/profile', [AdminViewController::class, 'admin_profile']);
    Route::get('/admin/deposite', [AdminViewController::class, 'admin_deposite']);
    Route::get('/admin/activation-id', [AdminViewController::class, 'admin_activation_id']);
    Route::get('/admin/withdraw', [AdminViewController::class, 'admin_withdraw']);
    Route::get('/admin/all-team', [AdminViewController::class, 'admin_all_team']);
    Route::get('/admin/layer-1', [AdminViewController::class, 'admin_layer_1_team']);
    Route::get('/admin/layer', [AdminViewController::class, 'admin_layer_team']);
    Route::get('/admin/level-wise-gridlist', [AdminViewController::class, 'admin_level_wise_gridlist']);
    Route::get('/admin/transaction-history', [AdminViewController::class, 'admin_transaction_history']);
    Route::get('/admin/tree-view', [AdminViewController::class, 'admin_tree']);
    Route::get('/admin/change-password', [AdminViewController::class, 'admin_change_password']);
    Route::get('/admin/user-profile/{id}', [AdminViewController::class, 'admin_user_profile_update']);
});
