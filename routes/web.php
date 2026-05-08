<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('landing.home');
})->name('home');

Route::get('/about', function () {
    return view('landing.about');
})->name('about');


Route::get('/academics', function () {
    return view('landing.academics');
})->name('academics');

Route::get('/admissions', function () {
    return view('landing.admissions');
})->name('admissions');


Route::get('/contact', function () {
    return view('landing.contact');
})->name('contact');

Route::get('/gallery', function () {
    return view('landing.gallery');
})->name('gallery');


Route::get('/news', function () {
    return view('landing.news');
})->name('news');

Route::get('/news/{slug}', function ($slug) {
    return view('landing.news.show', compact('slug'));
})->name('news.show');


Route::get('/apply', function () {
    return view('landing.apply');
})->name('apply');

