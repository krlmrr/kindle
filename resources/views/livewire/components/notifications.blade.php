<?php
    use Livewire\Attributes\On;
    use function Livewire\Volt\{on, state};

    state([
        'notifications' => auth()->user()->notifications()->get(),
        'userId' => auth()->user()->id,
    ]);

    on(['echo-private:App.Models.User.{userId},.notification' => function ($notification) {
        dd($this->notifications);
        // $this->notifications->;
    }]);
?>

<div>
    <flux:dropdown align="end">
        <flux:button variant="ghost">
            @if (count($notifications) > 0)
                <flux:icon.bell-alert class="dark:text-gray-300" />
            @else
                <flux:icon.bell class="dark:text-gray-400"/>
            @endif
        </flux:button>

        <flux:menu>
            @if(count($notifications))
                @foreach($notifications as $notification)
                    <flux:menu.item>
                        {{ $notification->data['message'] }}
                    </flux:menu.item>
                @endforeach
            @else
                <flux:menu.item>
                    No notifications
                </flux:menu.item>
            @endif
        </flux:menu>
    </flux:dropdown>
</div>
