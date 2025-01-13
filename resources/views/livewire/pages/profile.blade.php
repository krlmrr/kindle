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
            <livewire:partials.profile.update-profile-information-form />
        </flux:card>

        <flux:card>
            <livewire:partials.profile.update-password-form />
        </flux:card>

        <flux:card>
            <livewire:partials.profile.two-factor-authentication />
        </flux:card>

        <flux:card>
            <livewire:partials.profile.delete-user-form />
        </flux:card>
    </flux:main>
</x-app-layout>
