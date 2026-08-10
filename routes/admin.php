<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CompanyStatController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GlobalMarketController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\QualityProcessController;
use App\Http\Controllers\Admin\ResponsibilityItemController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TranslateController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'create'])->name('login');
        Route::post('login', [AuthController::class, 'store'])
            ->middleware('throttle:5,1')
            ->name('login.store');

        Route::get('forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
        Route::post('forgot-password', [AuthController::class, 'sendResetLink'])
            ->middleware('throttle:5,1')
            ->name('password.email');
        Route::get('reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
        Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
    });

    Route::post('logout', [AuthController::class, 'destroy'])
        ->middleware('auth')
        ->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('products', ProductController::class)->except('show');
        Route::resource('categories', ProductCategoryController::class)->except('show');
        Route::resource('quality', QualityProcessController::class)->except('show');
        Route::resource('global-reach', GlobalMarketController::class)->except('show');
        Route::resource('company-stats', CompanyStatController::class)->except('show');
        Route::resource('responsibility', ResponsibilityItemController::class)->except('show');

        Route::get('pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('pages/{page:slug}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('pages/{page:slug}', [PageController::class, 'update'])->name('pages.update');

        Route::get('media', [MediaController::class, 'index'])->name('media.index');
        Route::post('media', [MediaController::class, 'store'])->name('media.store');
        Route::put('media/{medium}', [MediaController::class, 'update'])->name('media.update');
        Route::delete('media/{medium}', [MediaController::class, 'destroy'])->name('media.destroy');

        Route::get('inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('inquiries/export', [InquiryController::class, 'export'])->name('inquiries.export');
        Route::get('inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
        Route::put('inquiries/{inquiry}', [InquiryController::class, 'update'])->name('inquiries.update');
        Route::delete('inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');

        Route::get('seo', [SeoController::class, 'index'])->name('seo.index');
        Route::get('seo/{type}/{id}/edit', [SeoController::class, 'edit'])->name('seo.edit');
        Route::put('seo/{type}/{id}', [SeoController::class, 'update'])->name('seo.update');

        Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');

        Route::post('translate', TranslateController::class)->name('translate');
    });
});
