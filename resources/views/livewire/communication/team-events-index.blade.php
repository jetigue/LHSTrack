<div>
    <x-flash />
    <x-headings.page>
        Team Events
        <x-slot name="action">
            @can('coach')
                <x-button.primary wire:click="showFormModal">
                    <x-icon.plus class="mr-2" />
                    New Event
                </x-button.primary>
            @endcan
        </x-slot>
    </x-headings.page>

    <div class="flex">
        <div class="hidden md:flex md:w-1/3 lg:w-1/4">
            <x-navigation.user-menu title="Communication">
                <x-navigation.user-menu-item route="Team Announcements">Team Announcements</x-navigation.user-menu-item>
                <x-navigation.user-menu-item route="Team Events">Team Events</x-navigation.user-menu-item>
            </x-navigation.user-menu>
        </div>
        <div class="flex w-full md:w-2/3 lg:w-3/4">
            <div class="grid grid-cols-4 gap-6">
                @foreach ($events->where('event_date', '>=',\Carbon\Carbon::now()->format('Y-m-d')) as $event)
                    <div wire:key="{{ $loop->index }}"
                         class=" col-span-4 md:col-span-2 lg:col-span-1 relative bg-white shadow rounded-md px-6 py-4">
                        @can('coach')
                            <div class="flex absolute justify-between top-2 right-2 z-10">
                                <div class="p-1">
                                    <x-dropdown.dropdown>
                                        <x-slot name="trigger">
                                            <x-icon.dots-vertical class="text-gray-300 hover:text-blue-500" />
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown.link wire:click="goToEvent">
                                                View Event
                                            </x-dropdown.link>
                                            <div class="px-2">
                                                <hr>
                                            </div>
                                            <x-dropdown.link wire:click="editEvent({{$event->id}})">
                                                Edit
                                            </x-dropdown.link>
                                            <x-dropdown.link wire:click="confirmDelete({{ $event->id }})">
                                                Delete
                                            </x-dropdown.link>
                                        </x-slot>
                                    </x-dropdown.dropdown>
                                </div>
                            </div>
                        @endcan
                        <div class="py-4">
                            <div class="flex flex-col w-full">
                                <div class="flex text-sm text-gray-400 font-semibold justify-center w-full">
                                    {{ $event->event_date->format('F j') }}
                                </div>
                                <div class="text-sm font-bold text-red-800 py-1">
                                    {{ $event->title }}
                                </div>
                                <div class="text-gray-700 text-sm text-left">
                                    {!! $event->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('livewire.communication._confirm-delete-event-modal')
                @endforeach

                @foreach ($events->where('event_date', '<',\Carbon\Carbon::now()->format('Y-m-d')) as $event)
                    <div wire:key="{{ $loop->index }}"
                         class=" col-span-4 md:col-span-2 lg:col-span-1 relative bg-gray-300 shadow rounded-md px-6 py-4">
                        @can('coach')
                            <div class="flex absolute justify-between top-2 right-2 z-10">
                                <div class="p-1">
                                    <x-dropdown.dropdown>
                                        <x-slot name="trigger">
                                            <x-icon.dots-vertical class="text-gray-300 hover:text-blue-500" />
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown.link wire:click="goToEvent">
                                                View Event
                                            </x-dropdown.link>
                                            <div class="px-2">
                                                <hr>
                                            </div>
                                            <x-dropdown.link wire:click="editEvent({{$event->id}})">
                                                Edit
                                            </x-dropdown.link>
                                            <x-dropdown.link wire:click="confirmDelete({{ $event->id }})">
                                                Delete
                                            </x-dropdown.link>
                                        </x-slot>
                                    </x-dropdown.dropdown>
                                </div>
                            </div>
                        @endcan
                        <div class="py-4">
                            <div class="flex flex-col w-full">
                                <div class="flex text-sm text-gray-400 font-semibold justify-center w-full">
                                    {{ $event->event_date->format('F j') }}
                                </div>
                                <div class="text-sm font-bold text-red-800 py-1">
                                    {{ $event->title }}
                                </div>
                                <div class="text-gray-700 text-sm text-left">
                                    {!! $event->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('livewire.communication._confirm-delete-event-modal')
                @endforeach


            </div>
        </div>

    </div>


    @include('livewire.communication._team-event-form-modal')
</div>
