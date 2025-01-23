<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state([
    'current_password' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'current_password' => ['required', 'string', 'current_password'],
    'password' => ['required', 'string', Password::defaults(), 'confirmed'],
]);

$updatePassword = function () {
    try {
        $validated = $this->validate();
    } catch (ValidationException $e) {
        $this->reset('current_password', 'password', 'password_confirmation');

        throw $e;
    }

    Auth::user()->update([
        'password' => Hash::make($validated['password']),
    ]);

    $this->reset('current_password', 'password', 'password_confirmation');

    $this->dispatch('password-updated');

    Flux::toast('Your password has been updated.');
};

?>

<section>
    <flux:heading size="lg">
        Update Password
    </flux:heading>

    <flux:subheading>
        Ensure your account is using a long, random password to stay secure.
    </flux:subheading>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
        <flux:input
            label="Current Password"
            name="current_password"
            type="password"
            autocomplete="current-password"
            wire:model="current_password"
        />

        <flux:input
            label="New Password"
            wire:model="password"
            name="password"
            type="password"
            autocomplete="new-password"
        />

        <flux:input
            label="Confirm Password"
            wire:model="password_confirmation"
            name="password_confirmation"
            type="password"
            autocomplete="new-password"
        />

        <flux:button
            type="submit"
            variant="primary"
        >
            Save
        </flux:button>
    </form>
</section>
