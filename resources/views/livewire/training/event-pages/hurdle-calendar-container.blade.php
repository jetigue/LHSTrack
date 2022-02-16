<div class="w-full" x-cloak x-data="{ open: false }">
    <div class="hidden md:flex w-full justify-center">
        <livewire:training.event-pages.hurdle-workout-calendar
            before-calendar-view="livewire/training/event-pages/_hurdle-calendar-heading"
        />
    </div>
    <div class="flex flex-col w-full md:hidden">
        <x-headings.page>
            <div class="flex w-full justify-between">
                Hurdler Calendar
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

        @include('livewire.training.event-pages._hurdle-mobile-menu')
        <ul class="flex flex-col w-full space-y-2">
            @foreach($workouts as $workout)
                <li wire:key="{{ $loop->index }}" class="w-full">
                    <x-card.basic wire:click="showMobileModal({{ $workout->id }})">
                        <div class="flex flex-col">
                            <div class="flex text-sm text-gray-400 font-semibold justify-center w-full">
                                {{ $workout->workout_date->format('F j') }}
                            </div>
                            <div class="text-sm font-bold text-red-800 py-1">
                                {{ $workout->title }}
                            </div>
                            <hr>
                            <div class="py-2 text-sm text-gray-600 line-clamp-2">
                                {!! $workout->description !!}
                            </div>
                        </div>
                    </x-card.basic>
                </li>
            @endforeach
        </ul>
    </div>

    @if($workout)
        <x-modal.dialog wire:model="showEventModal">
            <x-slot name="title">
                {{ $workout->workout_date->format('F j') }}
            </x-slot>
            <x-slot name="content">
                <div class="font-bold text-red-800">
                    {{ $workout->title }}
                </div>

                <div class="py-2 no-tailwindcss-base">
                    {!! $workout->description !!}
                </div>

            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="hideModal">Dismiss</x-button.secondary>
            </x-slot>

        </x-modal.dialog>
    @endif

</div>
