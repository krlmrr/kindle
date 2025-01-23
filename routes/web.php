<?php

use Livewire\Volt\Volt;

Volt::route('/', 'home')->name('home');

require __DIR__ . '/auth.php';
