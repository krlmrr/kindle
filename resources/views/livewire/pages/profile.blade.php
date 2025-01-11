<?php

use function Laravel\Folio\name;
use function Laravel\Folio\{middleware};

name('profile');
middleware(['auth', 'verified']);

?>

<x-app-layout>
    <x-slot name="header">
        Profile
    </x-slot>

    <flux:main container class="space-y-6">
        <flux:card>
            <livewire:components.profile.update-profile-information-form />
        </flux:card>

        <flux:card>
            <livewire:components.profile.update-password-form />
        </flux:card>

        <flux:card>
            <livewire:components.profile.delete-user-form />
        </flux:card>
    </flux:main>
</x-app-layout>
