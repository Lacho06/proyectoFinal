<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CulturalWorkController;
use App\Http\Controllers\RestorationPlanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', function(){
    return redirect()->route('home');
});

Route::post('/search', [HomeController::class, 'search'])->name('home.search');

Route::get('/mark-as-read/{notification}', [AdminController::class,'markAsRead'])->name('mark-as-read');

Route::get('/mark-all-as-read', [AdminController::class,'markAllAsRead'])->name('mark-all-as-read');

Route::get('cultural-work/{cultural_work}', [HomeController::class, 'show'])->name('home.show');

Route::post('admin/plan/associate-cultural-work', [RestorationPlanController::class, 'associateCulturalWork'])->name('restorationPlan.associateCulturalWork');

Route::post('admin/plan/unassociate-cultural-work', [RestorationPlanController::class, 'unassociateCulturalWork'])->name('restorationPlan.unassociateCulturalWork');

Route::get('admin/plan/{restoration_plan}/generate-plan', [RestorationPlanController::class, 'generatePlan'])->name('restorationPlan.generatePlan');

Route::get('admin/plan/generate-report', [RestorationPlanController::class, 'generateReport'])->name('restorationPlan.generateReport');

Route::get('admin/cultural-work/generate-report', [CulturalWorkController::class, 'generateReport'])->name('culturalWork.generateReport');

Route::get('admin/plan/download-report', [RestorationPlanController::class, 'downloadReport'])->name('restorationPlan.downloadReport');

Route::get('admin/cultural-work/download-report', [CulturalWorkController::class, 'downloadReport'])->name('culturalWork.downloadReport');

Route::resource('admin/restoration-plan', RestorationPlanController::class)->middleware(['auth'])->names('restorationPlan');

Route::resource('admin/author', AuthorController::class)->middleware(['auth'])->names('author');

Route::resource('admin/cultural-work', CulturalWorkController::class)->middleware(['auth'])->names('culturalWork');

Route::resource('admin/user', UserController::class)->middleware(['auth'])->names('user');

Route::resource('admin', AdminController::class)->only(['index'])->middleware(['auth'])->names('admin');

Auth::routes();
