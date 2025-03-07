<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
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

    // Role-Specific Dashboard Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('dashboard.admin');
        })->name('admin.dashboard')->middleware('role:admin');
    
        Route::get('/customer/dashboard', function () {
            return view('dashboard.customer');
        })->name('customer.dashboard')->middleware('role:customer');
    
        Route::get('/support/dashboard', function () {
            return view('dashboard.support');
        })->name('support.dashboard')->middleware('role:support_staff');
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