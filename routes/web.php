<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobApplicationController;

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AlumniProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    // Admin routes for managing jobs
    Route::middleware('role:admin|super-admin')->group(function () {
        Route::resource('jobs', JobController::class)->except(['index', 'show']);
    });

    // Routes for viewing jobs and applying (accessible to all authenticated users)
    Route::middleware('role:alumni')->group(function () {
        Route::post('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');
    });

    // Viewing job details (accessible to all authenticated users)
    Route::resource('jobs', JobController::class)->only(['index', 'show']);
});



// routes/web.php

Route::middleware('auth')->group(function () {
    Route::resource('job-applications', JobApplicationController::class);
    
});




// routes/web.php

// routes/web.php



Route::middleware('auth')->group(function () {
    Route::get('portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
    Route::get('portfolios/create', [PortfolioController::class, 'create'])->name('portfolios.create');
    Route::post('portfolios', [PortfolioController::class, 'store'])->name('portfolios.store');
    Route::get('portfolios/{portfolio}', [PortfolioController::class, 'show'])->name('portfolios.show');
    Route::get('portfolios/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('portfolios.edit');
    Route::put('portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolios.update');
});

Route::middleware(['auth', 'can:review,App\Models\Portfolio'])->group(function () {
    Route::get('admin/portfolios/review', [PortfolioController::class, 'reviewIndex'])->name('admin.portfolios.review');
    Route::put('/admin/portfolios/{portfolio}/review/{status}', [PortfolioController::class, 'review'])->name('admin.portfolios.updateReview');
});

// Resource routes for portfolios
Route::resource('portfolios', PortfolioController::class)->except(['index', 'show']); // Exclude if you have custom routes for these




Route::middleware(['auth'])->group(function () {
    Route::get('alumni_profiles', [AlumniProfileController::class, 'index'])->name('alumni_profiles.index');
    Route::get('alumni_profiles/create', [AlumniProfileController::class, 'create'])->name('alumni_profiles.create');
    Route::post('alumni_profiles', [AlumniProfileController::class, 'store'])->name('alumni_profiles.store');
    Route::get('alumni_profiles/{alumniProfile}', [AlumniProfileController::class, 'show'])->name('alumni_profiles.show');
    Route::get('alumni_profiles/{alumniProfile}/edit', [AlumniProfileController::class, 'edit'])->name('alumni_profiles.edit');
    Route::put('alumni_profiles/{alumniProfile}', [AlumniProfileController::class, 'update'])->name('alumni_profiles.update');
});



// Other routes
Route::group(['middleware'=>['role:super-admin|admin']], function () {
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

   
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
