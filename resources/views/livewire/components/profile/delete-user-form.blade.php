<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state(['password' => '']);

rules(['password' => ['required', 'string', 'current_password']]);

$deleteUser = function (Logout $logout) {
    $this->validate();

    tap(Auth::user(), $logout(...))->delete();

    $this->redirect('/', navigate: true);
};

?>

<section>
    <flux:heading size="lg">
        Delete Account
    </flux:heading>

    <flux:subheading>
        Once your account is deleted, all of its resources and data will be permanently deleted.
        Before deleting your account, please download any data or information that you wish to retain.
    </flux:subheading>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" class="mt-4">
            Delete Account
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion">
        <form wire:submit="deleteUser" class="p-6 space-y-6">
            <flux:heading size="lg">
                Are you sure you want to delete your account?
            </flux:heading>

            <flux:subheading>
                Once your account is deleted, all of its resources and data will be permanently deleted.
                Please enter your password to confirm you would like to permanently delete your account.
            </flux:subheading>

            <flux:input
                wire:model="password"
                placeholder="Password"
                type="password"
                autocomplete="current-password"
            />

            <div class="mt-6 space-x-3 flex justify-end">
                <flux:modal.close>
                    <flux:button variant="ghost">
                        Cancel
                    </flux:button>
                </flux:modal.close>

                <flux:button
                    variant="danger"
                    type="submit"
                >
                    Delete Account
                </flux:button>
            </div>
        </form>
    </flux:modal>
</section>
