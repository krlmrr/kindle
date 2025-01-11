<?php

use function Laravel\Folio\name;
use function Laravel\Folio\{middleware};

name('dashboard');
middleware(['auth', 'verified']);

?>

<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <flux:main container class="space-y-6">
        <flux:card>
            You're logged in!
        </flux:card>
    </flux:main>
</x-app-layout>
