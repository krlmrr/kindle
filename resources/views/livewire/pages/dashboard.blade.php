<?php
    use function Laravel\Folio\name;
    use Livewire\Volt\Component;
    use App\Notifications\TestNotification;
    use function Laravel\Folio\{middleware};

    name('dashboard');
    middleware(['auth', 'verified']);

    new class extends Component {
        public function sendTestNotification()
        {
            return auth()->user()->notify(new TestNotification());
        }
    }
?>

<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <flux:main container class="space-y-6">
        <flux:card>
            You're logged in!

            <flux:button wire:click="sendTestNotification()">
                Send Test Notification
            </flux:button>
        </flux:card>
    </flux:main>
</x-app-layout>
