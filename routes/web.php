<?php

use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\CompanyProfileController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\GlobalReachController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\LegalController;
use App\Http\Controllers\Public\ProductController;
use App\Http\Controllers\Public\QualityController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/about', AboutController::class)->name('about');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/quality', QualityController::class)->name('quality');
Route::get('/global-reach', GlobalReachController::class)->name('global-reach');
Route::get('/company-profile', CompanyProfileController::class)->name('company-profile');

Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');
Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
