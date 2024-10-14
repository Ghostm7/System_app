<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    JobController,
    ProfileController,
    JobApplicationController,
    PortfolioController,
    AlumniProfileController,
    PermissionController,
    RoleController,
    UserController,
    Auth\RegisteredUserController,
};

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Main landing route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // User Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Job Applications
    Route::resource('job-applications', JobApplicationController::class);

    // Portfolios
    Route::resource('portfolios', PortfolioController::class)->except(['index', 'show']);
    Route::get('portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
    Route::get('portfolios/create', [PortfolioController::class, 'create'])->name('portfolios.create');
    Route::post('portfolios', [PortfolioController::class, 'store'])->name('portfolios.store');
    Route::get('portfolios/{portfolio}', [PortfolioController::class, 'show'])->name('portfolios.show');
    Route::get('portfolios/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('portfolios.edit');
    Route::put('portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolios.update');

    // Alumni Profiles
    Route::resource('alumni_profiles', AlumniProfileController::class);

    // Viewing Job Details and Applying (for authenticated users)
    Route::resource('jobs', JobController::class)->only(['index', 'show']);
    Route::middleware('role:alumni')->group(function () {
        Route::post('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');
    });
});

// Admin and Super Admin Routes
Route::middleware('auth')->group(function () {
    Route::middleware('role:admin|super-admin')->group(function () {
        // Job Management
        Route::resource('jobs', JobController::class)->except(['index', 'show']);

        // Explicit route for creating a job
        Route::get('/jobs/{job}/create', [JobController::class, 'create'])->name('jobs.create');



        // Portfolio Review
        Route::get('admin/portfolios/review', [PortfolioController::class, 'reviewIndex'])->name('admin.portfolios.review');
        Route::put('/admin/portfolios/{portfolio}/review/{status}', [PortfolioController::class, 'review'])->name('admin.portfolios.updateReview');

        // Permissions and Roles Management
        Route::resource('permissions', PermissionController::class);
        Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

        Route::resource('roles', RoleController::class);
        Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
        Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
        Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

        // User Management
        Route::resource('users', UserController::class);
        Route::get('users/{userId}/delete', [UserController::class, 'destroy']);

        // Super Admin Registration Routes
        Route::get('/register-super-admin', [RegisteredUserController::class, 'createSuperAdmin'])->name('register.super_admin');
    });
});

// Require authentication routes
require __DIR__.'/auth.php';
