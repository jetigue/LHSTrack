<div class="w-full" x-cloak x-data="{ open: false }">
    <x-flash />
    <x-headings.page>
        <div class="flex w-full justify-between">
            Hurdles
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

    <div class="grid grid-cols-8 gap-4">

        <div class="hidden lg:block lg:col-span-1 space-y-1.5 items-start pt-6">
            <x-navigation.user-menu-item route="Dashboard" class="-ml-5">Dashboard</x-navigation.user-menu-item>
            <x-navigation.user-menu title="Hurdles">
                <x-navigation.user-menu-item route="Hurdles">Home</x-navigation.user-menu-item>
                <x-navigation.user-menu-item route="Hurdles Calendar">Calendar</x-navigation.user-menu-item>
            </x-navigation.user-menu>
        </div>


        <div class="grid col-span-8 md:col-span-6 lg:col-span-5">
            <div class="flex w-full justify-between items-center flex-wrap">
                <div class="flex w-full md:w-1/2 text-gray-500 text-2xl font-medium">{{ $whichWorkouts }} Workouts</div>
                <div class="flex w-full md:w-64 text-gray-800 py-3">
                    <x-input.select wire:model="timeFrame">
                        <option value=">=">Show Upcoming Workouts</option>
                        <option value="<">Show Past Workouts</option>
                        <option value="">Show All Workouts</option>
                    </x-input.select>
                </div>
            </div>
            <x-table.table class="table-fixed relative py-2">
                <x-slot name="head">
                    <x-table.header-row class="items-baseline">

                        <x-table.heading class="flex w-11/12 md:w-3/12">
                            Date
                        </x-table.heading>

                        <x-table.heading class="hidden md:flex md:w-3/12">
                            Title
                        </x-table.heading>

                        <x-table.heading class="hidden md:flex md:w-3/12">
                            Description
                        </x-table.heading>

                        <x-table.heading class="w-1/12">
                            @can('coach')
                                <x-button.plus />
                            @endcan
                        </x-table.heading>

                    </x-table.header-row>
                </x-slot>

                <x-slot name="body">
                    @forelse($workouts as $workout)
                        <x-table.row
                            wire:key="{{ $loop->index }}"
                            x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                            wire:loading.class.delay="opacity-50 font-semibold cursor-pointer"
                        >
                            <x-table.cell class="flex w-5/12 md:w-3/12">
                                {{ $workout->workout_date->format('M j, Y') }}
                            </x-table.cell>

                            <x-table.cell class="hidden md:flex md:w-3/12">
                                {{ $workout->title }}
                            </x-table.cell>

                            <x-table.cell class="hidden md:flex md:w-3/12 line-clamp-1">
                                {{ substr(strip_tags($workout->description), 0) }}
                            </x-table.cell>

                            <x-table.cell wire:click="showWorkoutModal"
                                          class="w-5/12 md:w-2/12 text-sm text-gray-400 hover:text-red-900 text-center font-semibold cursor-pointer">
                                View
                            </x-table.cell>

                            <x-table.cell class="w-1/12 flex justify-end">
                                @can('coach')
                                    <x-dropdown.dropdown>
                                        <x-slot name="trigger">
                                            <x-icon.dots-vertical class="text-gray-300 hover:text-red-700" />
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown.link wire:click="editWorkout({{ $workout->id }})">
                                                Edit
                                            </x-dropdown.link>
                                            <x-dropdown.link wire:click="confirmWorkoutDelete({{ $workout->id }})">
                                                Delete
                                            </x-dropdown.link>
                                        </x-slot>
                                    </x-dropdown.dropdown>
                                @endcan
                            </x-table.cell>
                        </x-table.row>

                        <x-modal.confirmation wire:model.defer="showConfirmModal">
                            <x-slot name="title">Delete Workout?</x-slot>
                            <x-slot name="content">Are you sure you want to delete this workout? This cannot be
                                undone.
                            </x-slot>
                            <x-slot name="footer">
                                <x-button.tertiary wire:click="$toggle('showConfirmModal')">
                                    Cancel
                                </x-button.tertiary>
                                <x-button.danger wire:click="destroy({{ $workout->id }})">
                                    Yes, Delete Workout
                                </x-button.danger>
                            </x-slot>
                        </x-modal.confirmation>
                    @empty
                        <x-table.row class="flex w-full">
                            <x-no-records missing-record="Workout" />
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table.table>
            <div class="text-gray-300 py-2">
                {{ $workouts->links() }}
            </div>
        </div>
        <div class="hidden md:grid md:col-span-2 mt-5 pl-8">
            <div class="flex flex-col">
                <div class="flex justify-between">
                    <div class="flex w-full text-gray-500 text-2xl font-medium">
                        Links
                    </div>

                    @can('coach')
                        <x-button.primary wire:click="addHurdleLink">
                            <x-icon.plus />
                            Add Link
                        </x-button.primary>
                    @endcan
                </div>

                <ul class="flex w-full py-4 space-y-2">
                    @foreach($hurdleLinks as $link)
                        <li class="flex w-full justify-between">
                            <a class="text-gray-400 font-semibold hover:text-gray-200"
                               href="{{ $link->url }}">
                                {{ $link->text }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

    @if ($this->addingEditingWorkout == true)
        <x-modal.add-edit-record record-title="Workout">
            <livewire:training.event-pages.hurdle-workout-form />
        </x-modal.add-edit-record>
    @elseif ($this->addingEditingLink == true)
        <x-modal.add-edit-record record-title="Link">
            <livewire:training.event-pages.hurdle-link-form />
        </x-modal.add-edit-record>
    @endif

    @if($workout)
        <x-modal.dialog wire:model="viewWorkout">
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
                <x-button.secondary wire:click="hideWorkoutModal">Dismiss</x-button.secondary>
            </x-slot>
        </x-modal.dialog>
    @endif
</div>
