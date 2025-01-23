<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('components.layouts.guest');

state(['password' => '']);

rules(['password' => ['required', 'string']]);

$confirmPassword = function () {
    $this->validate();

    if (! Auth::guard('web')->validate([
        'email' => Auth::user()->email,
        'password' => $this->password,
    ])) {
        throw ValidationException::withMessages([
            'password' => __('auth.password'),
        ]);
    }

    session(['auth.password_confirmed_at' => time()]);

    $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
};

?>

<div>
    <div class="mb-4 text-sm">
        This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <form wire:submit="confirmPassword">
        <flux:input
            wire:model="password"
            label="Password"
            type="password"
            required
            autocomplete="current-password"
        />

        <div class="flex justify-end mt-4">
            <flux:button
                variant="primary"
                type="submit"
            >
                Confirm
            </flux:button>>
        </div>
    </form>
</div>
