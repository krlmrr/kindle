<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\{layout, form};

layout('components.layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
};

?>

<div>
    @volt('pages.login')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-4">
        <flux:input
            wire:model="form.email"
            label="Email"
            required
            autofocus
            autocomplete="username"
        />

        <flux:input
            wire:model="form.password"
            label="Password"
            type="password"
            required
            autocomplete="current-password"
        />

        <flux:checkbox
            wire:model="form.remember"
            label="Remember me"
        />

        <div class="flex items-center justify-end mt-4 space-x-3">
            @if (Route::has('password.request'))
                <flux:button
                    href="{{ route('password.request') }}"
                    wire:navigate
                    variant="subtle"
                >
                    Forgot your password?
                </flux:button>
            @endif

            <flux:button
                variant="primary"
                type="submit"
            >
                Log in
            </flux:button>
        </div>
    </form>
    @endvolt
</div>
