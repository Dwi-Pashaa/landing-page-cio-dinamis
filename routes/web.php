<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\PaketInternetController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\TutorialAdminController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\KeunggulanController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/tentang-kami', [TentangKamiController::class, 'index']);
Route::get('/paket-internet', [PaketInternetController::class, 'index']);
Route::get('/tutorial', [TutorialController::class, 'index']);
Route::get('/tutorial/{slug}', [TutorialController::class, 'show']);
Route::get('/kontak', [KontakController::class, 'index']);

Route::prefix('/cms')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/settings', [SiteSettingController::class, 'index'])->middleware('can:view-settings');
        Route::put('/settings', [SiteSettingController::class, 'update'])->middleware('can:update-settings');

        Route::get('/hero/edit', [HeroController::class, 'edit'])->middleware('can:view-hero');
        Route::put('/hero', [HeroController::class, 'update'])->middleware('can:update-hero');

        Route::get('/paket', [PaketController::class, 'index'])->middleware('can:view-paket');
        Route::get('/paket/create', [PaketController::class, 'create'])->middleware('can:create-paket');
        Route::post('/paket', [PaketController::class, 'store'])->middleware('can:create-paket');
        Route::get('/paket/{id}/edit', [PaketController::class, 'edit'])->middleware('can:edit-paket');
        Route::put('/paket/{id}', [PaketController::class, 'update'])->middleware('can:edit-paket');
        Route::delete('/paket/{id}', [PaketController::class, 'destroy'])->middleware('can:delete-paket');

        Route::get('/tutorial', [TutorialAdminController::class, 'index'])->middleware('can:view-tutorial');
        Route::get('/tutorial/create', [TutorialAdminController::class, 'create'])->middleware('can:create-tutorial');
        Route::post('/tutorial', [TutorialAdminController::class, 'store'])->middleware('can:create-tutorial');
        Route::get('/tutorial/{id}/edit', [TutorialAdminController::class, 'edit'])->middleware('can:edit-tutorial');
        Route::put('/tutorial/{id}', [TutorialAdminController::class, 'update'])->middleware('can:edit-tutorial');
        Route::delete('/tutorial/{id}', [TutorialAdminController::class, 'destroy'])->middleware('can:delete-tutorial');

        Route::post('/upload-image', [TutorialAdminController::class, 'uploadImage'])->middleware('can:create-tutorial');
        Route::post('/upload-video', [TutorialAdminController::class, 'uploadVideo'])->middleware('can:create-tutorial');

        Route::get('/tags', [TagController::class, 'index'])->middleware('can:view-tags');
        Route::get('/tags/create', [TagController::class, 'create'])->middleware('can:create-tags');
        Route::post('/tags', [TagController::class, 'store'])->middleware('can:create-tags');
        Route::get('/tags/{id}/edit', [TagController::class, 'edit'])->middleware('can:edit-tags');
        Route::put('/tags/{id}', [TagController::class, 'update'])->middleware('can:edit-tags');
        Route::delete('/tags/{id}', [TagController::class, 'destroy'])->middleware('can:delete-tags');

        Route::get('/keunggulan', [KeunggulanController::class, 'index'])->middleware('can:view-keunggulan');
        Route::get('/keunggulan/create', [KeunggulanController::class, 'create'])->middleware('can:create-keunggulan');
        Route::post('/keunggulan', [KeunggulanController::class, 'store'])->middleware('can:create-keunggulan');
        Route::get('/keunggulan/{id}/edit', [KeunggulanController::class, 'edit'])->middleware('can:edit-keunggulan');
        Route::put('/keunggulan/{id}', [KeunggulanController::class, 'update'])->middleware('can:edit-keunggulan');
        Route::delete('/keunggulan/{id}', [KeunggulanController::class, 'destroy'])->middleware('can:delete-keunggulan');

        Route::get('/seo', [SeoController::class, 'index'])->middleware('can:view-seo');
        Route::put('/seo', [SeoController::class, 'update'])->middleware('can:update-seo');

        Route::get('/analytics', [AnalyticsController::class, 'index'])->middleware('can:view-analytics');
        Route::delete('/analytics/clear', [AnalyticsController::class, 'clear'])->middleware('can:clear-analytics');

        Route::get('/users', [UserController::class, 'index'])->middleware('can:view-users');
        Route::get('/users/create', [UserController::class, 'create'])->middleware('can:create-users');
        Route::post('/users', [UserController::class, 'store'])->middleware('can:create-users');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware('can:edit-users');
        Route::put('/users/{id}', [UserController::class, 'update'])->middleware('can:edit-users');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('can:delete-users');

        Route::get('/roles', [RoleController::class, 'index'])->middleware('can:view-roles');
        Route::get('/roles/create', [RoleController::class, 'create'])->middleware('can:create-roles');
        Route::post('/roles', [RoleController::class, 'store'])->middleware('can:create-roles');
        Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->middleware('can:edit-roles');
        Route::put('/roles/{id}', [RoleController::class, 'update'])->middleware('can:edit-roles');
        Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->middleware('can:delete-roles');
    });
});
