<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

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

// Landing Pages
Route::get('/', function () { return view('landing.home'); })->name('home');
Route::get('/about', function () { return view('landing.about'); })->name('about');
Route::get('/academics', function () { return view('landing.academics'); })->name('academics');
Route::get('/admissions', function () { return view('landing.admissions'); })->name('admissions');
Route::get('/contact', function () { return view('landing.contact'); })->name('contact');
Route::get('/gallery', function () { return view('landing.gallery'); })->name('gallery');
Route::get('/news', function () { return view('landing.news'); })->name('news');
Route::get('/news/{slug}', function ($slug) { return view('landing.news.show', compact('slug')); })->name('news.show');
Route::get('/apply', function () { return view('landing.apply'); })->name('apply');

// Admin Auth Routes - Guest Only
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::get('/admin/forgot-password', [AuthController::class, 'showForgotPassword'])->name('admin.forgot-password');
    Route::post('/admin/forgot-password', [AuthController::class, 'sendResetLink'])->name('admin.forgot-password.post');
    Route::get('/admin/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('admin.reset-password');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/admin/reset-password', [AuthController::class, 'resetPassword'])->name('admin.reset-password.post');
});

// Admin Protected Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');
    
    // Admissions
    Route::get('/admissions', function () { return view('admin.admissions.index'); })->name('admissions.index');
    Route::get('/admissions/{id}', function ($id) { return view('admin.admissions.detail', compact('id')); })->name('admissions.detail');
    
    // Enquiries
    Route::get('/enquiries', function () { return view('admin.enquiries.index'); })->name('enquiries.index');
    
    // Content Management
    Route::get('/content', function () { return view('admin.content.index'); })->name('content.index');
    Route::get('/content/hero', function () { return view('admin.content.hero'); })->name('content.hero');
    Route::get('/content/about', function () { return view('admin.content.about'); })->name('content.about');
    Route::get('/content/programs', function () { return view('admin.content.programs'); })->name('content.programs');
    Route::get('/content/why-choose-us', function () { return view('admin.content.why-choose-us'); })->name('content.why-choose-us');
    Route::get('/content/gallery', function () { return view('admin.content.gallery'); })->name('content.gallery');
    Route::get('/content/testimonials', function () { return view('admin.content.testimonials'); })->name('content.testimonials');
    Route::get('/content/stats', function () { return view('admin.content.stats'); })->name('content.stats');
    Route::get('/content/footer', function () { return view('admin.content.footer'); })->name('content.footer');
    
    // Events
    Route::get('/events', function () { return view('admin.events.index'); })->name('events.index');
    Route::get('/events/create', function () { return view('admin.events.editor'); })->name('events.create');
    Route::get('/events/{id}/edit', function ($id) { return view('admin.events.editor', compact('id')); })->name('events.edit');
    
    // Blog/News
    Route::get('/blog', function () { return view('admin.blog.index'); })->name('blog.index');
    Route::get('/blog/create', function () { return view('admin.blog.editor'); })->name('blog.create');
    Route::get('/blog/{id}/edit', function ($id) { return view('admin.blog.editor', compact('id')); })->name('blog.edit');
    Route::get('/blog/categories', function () { return view('admin.blog.categories'); })->name('blog.categories');
    
    // Media Library
    Route::get('/media', function () { return view('admin.media.index'); })->name('media.index');
    
    // Settings
    Route::get('/settings/general', function () { return view('admin.settings.general'); })->name('settings.general');
    Route::get('/settings/accounts', function () { return view('admin.settings.accounts'); })->name('settings.accounts');
    Route::get('/settings/security', function () { return view('admin.settings.security'); })->name('settings.security');
});
