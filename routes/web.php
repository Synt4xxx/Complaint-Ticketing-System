<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
*/

// Home Route
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes (for guest users)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// Logout Route (for authenticated users)
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Protected Routes (only for authenticated users)
Route::middleware('auth')->group(function () {
    
    // Admin Routes (only for admins)
    Route::prefix('admin')->middleware('role:admin')->group(function() {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/complaints', [AdminController::class, 'complaints'])->name('admin.complaints');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.user.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.user.update');
    });

    // Customer Routes (only for customers)
    Route::middleware('role:customer')->group(function () {
        Route::get('/customer/dashboard', function () {
            return view('dashboard.customer');
        })->name('customer.dashboard');
    });
    
    // Support Staff Routes (only for support staff)
    Route::middleware('role:support_staff')->group(function () {
        Route::get('/support/dashboard', function () {
            return view('dashboard.support');
        })->name('support.dashboard');
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Complaint Ticketing Routes
    Route::resource('complaints', ComplaintController::class);
});

// Include Laravel default auth routes (if needed)
require __DIR__.'/auth.php';
