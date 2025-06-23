<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Owner\PostController as OwnerPostController;
use App\Http\Controllers\Owner\ProfileController as OwnerProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Authentication routes สำหรับ User/Owner
Auth::routes(['register' => true]);

// Admin Authentication routes
Route::get('/dashboard-x1Z92a', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/dashboard-x1Z92a', [AdminLoginController::class, 'login']);
Route::post('/admin-logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// Owner routes
Route::middleware(['auth', 'check.owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/', [OwnerPostController::class, 'index'])->name('dashboard');
    Route::resource('posts', OwnerPostController::class);
    Route::get('/profile', [OwnerProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [OwnerProfileController::class, 'update'])->name('profile.update');
});

// Admin routes
Route::middleware(['auth', 'check.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Posts Management
    Route::resource('posts', AdminPostController::class);
    Route::post('/posts/{post}/toggle-featured', [AdminPostController::class, 'toggleFeatured'])->name('posts.toggle-featured');
    Route::post('/posts/{post}/toggle-published', [AdminPostController::class, 'togglePublished'])->name('posts.toggle-published');
    
    // User Management
    Route::resource('users', UserController::class);
    Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    
    // Categories Management
    Route::get('/categories/zones', [CategoryController::class, 'zones'])->name('categories.zones');
    Route::post('/categories/zones', [CategoryController::class, 'storeZone'])->name('categories.zones.store');
    Route::put('/categories/zones/{zone}', [CategoryController::class, 'updateZone'])->name('categories.zones.update');
    Route::delete('/categories/zones/{zone}', [CategoryController::class, 'destroyZone'])->name('categories.zones.destroy');
    
    Route::get('/categories/districts', [CategoryController::class, 'districts'])->name('categories.districts');
    Route::post('/categories/districts', [CategoryController::class, 'storeDistrict'])->name('categories.districts.store');
    Route::put('/categories/districts/{district}', [CategoryController::class, 'updateDistrict'])->name('categories.districts.update');
    Route::delete('/categories/districts/{district}', [CategoryController::class, 'destroyDistrict'])->name('categories.districts.destroy');
    
    Route::get('/categories/bts-stations', [CategoryController::class, 'btsStations'])->name('categories.bts-stations');
    Route::post('/categories/bts-stations', [CategoryController::class, 'storeBtsStation'])->name('categories.bts-stations.store');
    Route::put('/categories/bts-stations/{btsStation}', [CategoryController::class, 'updateBtsStation'])->name('categories.bts-stations.update');
    Route::delete('/categories/bts-stations/{btsStation}', [CategoryController::class, 'destroyBtsStation'])->name('categories.bts-stations.destroy');
    
    Route::get('/categories/types', [CategoryController::class, 'types'])->name('categories.types');
    Route::post('/categories/types', [CategoryController::class, 'storeType'])->name('categories.types.store');
    Route::put('/categories/types/{type}', [CategoryController::class, 'updateType'])->name('categories.types.update');
    Route::delete('/categories/types/{type}', [CategoryController::class, 'destroyType'])->name('categories.types.destroy');
    
    Route::get('/categories/facilities', [CategoryController::class, 'facilities'])->name('categories.facilities');
    Route::post('/categories/facilities', [CategoryController::class, 'storeFacility'])->name('categories.facilities.store');
    Route::put('/categories/facilities/{facility}', [CategoryController::class, 'updateFacility'])->name('categories.facilities.update');
    Route::delete('/categories/facilities/{facility}', [CategoryController::class, 'destroyFacility'])->name('categories.facilities.destroy');
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});