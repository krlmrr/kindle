<?php
    use App\Models\User;
    use App\Notifications\TestNotification;

    use function Livewire\Volt\{computed, state, title};

    title('Dashboard');

    state(['sortBy' => 'name', 'sortDirection' => 'desc']);

    $users = computed(function () {
        return User::query()->orderBy($this->sortBy, $this->sortDirection)->paginate(10);
    });

    $sendTestNotification = function() {
        return auth()->user()->notify(new TestNotification());
    };

    $sort = function($column) {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    };
?>

<div>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <flux:main container class="space-y-6">
        <flux:card>
            <flux:button wire:click="sendTestNotification()">
                Send Test Notification
            </flux:button>

            <p>
                {{ auth()->user()->id }}
            </p>
        </flux:card>

        <flux:card>
            <flux:heading size="lg">
                Users
            </flux:heading>

            <flux:subheading>
                A list of all users using this application.
            </flux:subheading>

            <flux:table :paginate="$this->users" class="mt-2">
                <flux:columns>
                    <flux:column
                        sortable
                        :sorted="$sortBy === 'name'"
                        :direction="$sortDirection"
                        wire:click="sort('name')"
                    >
                        Name
                    </flux:column>

                    <flux:column
                        sortable
                        :sorted="$sortBy === 'email'"
                        :direction="$sortDirection"
                        wire:click="sort('email')"
                    >
                        Email
                    </flux:column>

                    <flux:column
                        sortable
                        :sorted="$sortBy === 'created_at'"
                        :direction="$sortDirection"
                        wire:click="sort('created_at')"
                    >
                        Created At
                    </flux:column>
                    <flux:column
                        sortable
                        :sorted="$sortBy === 'updated_at'"
                        :direction="$sortDirection"
                        wire:click="sort('updated_at')"
                    >
                        Updated At
                    </flux:column>
                </flux:columns>

                <flux:rows>
                    @foreach ($this->users as $user)
                        <flux:row :key="$user->id">
                            <flux:column>
                                {{ $user->name }}
                            </flux:column>

                            <flux:column>
                                {{ $user->email }}
                            </flux:column>

                            <flux:column>
                                {{ Carbon\Carbon::parse($user->created_at)->format('m-d-Y') }}
                            </flux:column>

                            <flux:column>
                                {{ Carbon\Carbon::parse($user->updated_at)->format('m-d-Y') }}
                            </flux:column>
                        </flux:row>
                    @endforeach
                </flux:rows>
            </flux:table>
        </flux:card>
    </flux:main>
</div>
