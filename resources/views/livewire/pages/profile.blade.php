<?php
    use function Laravel\Folio\{name};
    use function Livewire\Volt\{title};

    title(fn () => 'Profile: ' . auth()->user()->name);

    name('profile');
?>

<x-layouts.app>
    @volt('pages.profile')
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
            <livewire:components.profile.two-factor-authentication />
        </flux:card>

        <flux:card>
            <livewire:components.profile.delete-user-form />
        </flux:card>
    </flux:main>
    @endvolt
</x-layouts.app>
