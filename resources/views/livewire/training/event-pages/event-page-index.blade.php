<div class="w-full" x-cloak x-data="{ open: false }">
    <x-headings.page>
        <x-slot name="breadcrumbs">
            <x-breadcrumb.menu>
                <x-breadcrumb.item href="{{ route($eventSubtype->name) }}-calendar" :leadingArrow="false">{{$eventSubtype->name}} Calendar</x-breadcrumb.item>
            </x-breadcrumb.menu>
        </x-slot>
        <div class="flex w-full justify-between">
            {{ $eventSubtype->name }} Page
            <x-slot name="action">
                <div class="flex lg:hidden">
                    <!-- Mobile menu button -->
                    <button @click="open = !open"
                            type="button"
                            class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                            aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <x-icon.menu x-bind:class="open ? 'hidden' : 'block'" />
                        <x-icon.x x-bind:class="open ? 'block' : 'hidden'" />
                    </button>
                </div>
            </x-slot>
        </div>
    </x-headings.page>

    @include('livewire.training.event-pages._event-page-mobile-menu')

    <div class="grid grid-cols-8 gap-4">

        <div class="hidden lg:block lg:col-span-1 space-y-1.5 items-start pt-5">
            <x-navigation.user-menu title="Event Pages">
                @foreach($eventSubtypes as $event)
                    <x-navigation.user-menu-item route="{{ $event->name }}">{{ $event->name }}</x-navigation.user-menu-item>
                @endforeach
            </x-navigation.user-menu>
            <x-navigation.user-menu title="Calendars">
                @foreach($eventSubtypes as $event)
                    <x-navigation.user-menu-item route="{{ $event->name }} Calendar">{{ $event->name }}</x-navigation.user-menu-item>
                @endforeach
            </x-navigation.user-menu>
        </div>


        <div class="grid col-span-8 md:col-span-6 lg:col-span-5">
            <div class="flex flex-col space-y-8 w-full">
                <livewire:training.event-pages.event-page-announcements-index :eventSubtype="$eventSubtype" />

                <livewire:training.event-pages.event-page-workouts-index :eventSubtype="$eventSubtype" />
            </div>
        </div>
        <div class="hidden md:grid md:col-span-2 mt-4 md:pl-2 lg:pl-8">
            <livewire:training.event-pages.event-page-links-index :eventSubtype="$eventSubtype" />
        </div>
    </div>
</div>
