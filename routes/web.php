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

Route::resource('admin/restoration-plan', RestorationPlanController::class)->middleware(['auth', 'menu.admin'])->names('restorationPlan');

Route::resource('admin/author', AuthorController::class)->middleware(['auth', 'menu.admin'])->names('author');

Route::resource('admin/cultural-work', CulturalWorkController::class)->middleware(['auth', 'menu.admin'])->names('culturalWork');

Route::resource('admin/user', UserController::class)->middleware(['auth', 'menu.admin'])->names('user');

Route::resource('admin', AdminController::class)->only(['index'])->middleware(['auth', 'menu.admin'])->names('admin');

Auth::routes();
