<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(route('dashboard', absolute: false), navigate: true);
};
?>

<div>
    {{-- @volt --}}
    <form wire:submit="register" class="space-y-4">
        <flux:input
            wire:model="name"
            label="Name"
            required
            autofocus
            autocomplete="name"
        />

        <flux:input
            wire:model="email"
            label="Email"
            required
            autocomplete="username"
        />

        <flux:input
            wire:model="password"
            label="Password"
            type="password"
            required
            autocomplete="new-password"
        />

        <flux:input
            wire:model="password_confirmation"
            label="Confirm Password"
            type="password"
            required
            autocomplete="new-password"
        />

        <div class="flex items-center justify-end mt-4 space-x-3">
            <flux:button
                href="{{ route('login') }}"
                wire:navigate
                variant="subtle"
            >
                Already registered?
            </flux:button>

            <flux:button
                variant="primary"
                type="submit"
            >
                Register
            </flux:button>
        </div>
    </form>
</div>
