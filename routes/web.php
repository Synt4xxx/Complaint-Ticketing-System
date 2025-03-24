<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupportController;
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

    // 🔹 Admin Routes (only for admins)
    Route::prefix('admin')->middleware('role:admin')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::get('/complaints', [AdminController::class, 'complaints'])->name('admin.complaints');
        Route::get('/complaints/{complaint}', [AdminController::class, 'showComplaint'])->name('admin.complaint-show');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.user.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.user.update');
        Route::delete('/users/{user}/delete', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
        Route::delete('/complaints/{id}', [AdminController::class, 'destroy'])->name('admin.complaints.destroy');
    });

    // 🔹 Customer Routes (only for customers)
    Route::prefix('customer')->middleware('role:customer')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'customer'])->name('customer.dashboard');

        // Complaint Routes for Customers
        Route::resource('/complaints', ComplaintController::class);
    });

    // 🔹 Support Staff Routes (only for support staff)
    Route::middleware(['auth'])->group(function () {
        Route::get('/support/dashboard', [SupportController::class, 'support'])->name('support.dashboard');
       
    Route::get('support/assigned-complaints', [SupportController::class, 'assignedComplaints'])
        ->name('support.assigned_complaints');

    Route::get('support/in-progress-complaints', [SupportController::class, 'inProgressComplaints'])
        ->name('support.in_progress_complaints');

    Route::get('support/resolved-complaints', [SupportController::class, 'resolvedComplaints'])
        ->name('support.resolved_complaints');

    Route::get('support/view-complaint/{id}', function ($id) {
        return "Complaint ID: " . $id;
    })->name('support.view_complaint'); // Placeholder route, replace with actual controller method
});
           
    // 🔹 Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

// Include Laravel default auth routes (if needed)
require __DIR__.'/auth.php';
