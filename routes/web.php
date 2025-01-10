<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages/welcome');

Route::view('dashboard', 'pages/dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'pages/profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
