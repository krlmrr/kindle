<?php

use function Livewire\Volt\state;

state(['tfa' => false]);

$enableTfa = function () {
    $response = Http::post('/user/two-factor-authentication');

    Flux::toast('Two-factor authentication has been enabled.');
};
?>

<section>
    <flux:heading size="lg">
        Two-Factor Authentication (2FA)
    </flux:heading>

    <flux:subheading>
        Ensure your account is safe by enabling two-factor authentication (2FA).
    </flux:subheading>

    <div class="mt-4">
        <flux:switch
            wire:model.live="tfa"
            label="Enable Two-Factor Authentication for This Account"
            wire:change="enableTfa"
        />
    </div>

    @if (session('status') == 'two-factor-authentication-enabled')
        <div class="mb-4 font-medium text-sm">
            Please finish configuring two factor authentication below.
        </div>
    @endif
</section>
