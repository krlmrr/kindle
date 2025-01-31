<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Redirect nova login to our login page
Route::get('nova/login', function () {
    return redirect(route('login'));
});

Volt::route('/', 'home')->name('home');

require __DIR__ . '/auth.php';
