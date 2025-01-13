<?php

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

use function Livewire\Volt\state;

state([
    'name' => fn () => auth()->user()->name,
    'email' => fn () => auth()->user()->email
]);

$updateProfileInformation = function () {
    $user = Auth::user();

    $validated = $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'lowercase',
            'email',
            'max:255',
            Rule::unique(User::class)->ignore($user->id)
        ],
    ]);

    $user->fill($validated);

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    $this->dispatch('profile-updated', name: $user->name);

    Flux::toast('Your profile information has been updated.');
};

$sendVerification = function () {
    $user = Auth::user();

    if ($user->hasVerifiedEmail()) {
        $this->redirectIntended(default: route('dashboard', absolute: false));

        return;
    }

    $user->sendEmailVerificationNotification();

    Session::flash('status', 'verification-link-sent');
};

?>

<section>
    <flux:heading size="lg">
        Profile Information
    </flux:heading>

    <flux:subheading>
        Update your account's profile information and email address.
    </flux:subheading>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <flux:input
            label="Name"
            name="name"
            autocomplete="name"
            autofocus
            required
            wire:model="name"
        />

        <flux:input
            name="email"
            label="Email"
            required
            autocomplete="username"
            wire:model="email"
        />

        @if (auth()->user() instanceof MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
            <div class="flex gap-4 items-center">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    Your email address is unverified.
                </p>

                <flux:button
                    wire:click.prevent="sendVerification"
                >
                    Resend the verification email.
                </flux:button>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        A new verification link has been sent to your email address.
                    </p>
                @endif
            </div>
        @endif

        <div class="flex items-center gap-4">
            <flux:button type="submit" variant="primary">
                Save
            </flux:button>
        </div>
    </form>
</section>
