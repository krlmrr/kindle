<?php
    use function Livewire\Volt\{title};

    title(fn () => 'Profile: ' . auth()->user()->name);
?>

<div>
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
</div>
