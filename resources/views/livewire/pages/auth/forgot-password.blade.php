<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state(['email' => '']);

rules(['email' => ['required', 'string', 'email']]);

$sendPasswordResetLink = function () {
    $this->validate();

    // We will send the password reset link to this user. Once we have attempted
    // to send the link, we will examine the response then see the message we
    // need to show to the user. Finally, we'll send out a proper response.
    $status = Password::sendResetLink(
        $this->only('email')
    );

    if ($status != Password::RESET_LINK_SENT) {
        $this->addError('email', __($status));

        return;
    }

    $this->reset('email');

    Session::flash('status', __($status));
};

?>

<div>
    {{-- @volt --}}
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Forgot your password? No problem.
        Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
    </div>

    <!-- Session Status -->
    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form wire:submit="sendPasswordResetLink">
        <flux:input
            wire:model="email"
            label="Email"
            required
            autofocus
            autocomplete="username"
        />

        <div class="flex items-center justify-end mt-4">
            <flux:button
                variant="primary"
                type="submit"
            >
                Email Password Reset Link
            </flux:button>
        </div>
    </form>
</div>
