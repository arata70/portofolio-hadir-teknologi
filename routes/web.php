<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Models\CompanyProfile;
use App\Models\Project;

/*
|--------------------------------------------------------------------------
| PUBLIC (FRONTEND)
|--------------------------------------------------------------------------
*/

// HOME
Route::get('/', function () {
    $projects = Project::where('status', 'publish')->latest()->get();
    $companyProfile = CompanyProfile::query()->first()
        ?? new CompanyProfile(CompanyProfile::defaultAttributes());

    return view('home', compact('projects', 'companyProfile'));
})->name('home');

// DETAIL PROJECT
Route::get('/projects/{project:slug}', function (Project $project) {
    return view('projects.show', compact('project'));
})->name('projects.show');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| ADMIN (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // DASHBOARD (PAKAI CONTROLLER!)
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        Route::patch('/dashboard/company-profile', [DashboardController::class, 'updateCompanyProfile'])
            ->name('dashboard.company-profile.update');

        // PROJECT CRUD (INDEX DIAHKAN KE POSTINGAN AGAR TIDAK DOUBLE)
        Route::get('/projects', function () {
            return redirect()->route('admin.posts.index');
        })->name('projects.index');
        Route::resource('/projects', ProjectController::class)->except(['show', 'index']);

        // POSTINGAN (DRAFT / PUBLISH)
        Route::get('/posts', [PostController::class, 'index'])
            ->name('posts.index');

        Route::patch('/posts/{project}/publish', [PostController::class, 'publish'])
            ->name('posts.publish');
    });
