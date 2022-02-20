<div class="flex w-full justify-between items-center flex-wrap">
    <div class="flex w-full md:w-1/2 text-gray-500 text-2xl font-medium">{{ $whichWorkouts }} Workouts</div>
    <div class="flex w-full md:w-64 text-gray-800 py-3">
        <x-input.select wire:model="workoutTimeFrame">
            <option value=">=">Upcoming Workouts</option>
            <option value="<">Past Workouts</option>
            <option value="">All Workouts</option>
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
                    <x-button.plus action="addWorkout" />
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
                                <x-dropdown.link wire:click="confirmDeleteWorkout({{ $workout->id }})">
                                    Delete
                                </x-dropdown.link>
                            </x-slot>
                        </x-dropdown.dropdown>
                    @endcan
                </x-table.cell>
            </x-table.row>

            <x-modal.confirmation wire:model.defer="showConfirmDeleteWorkoutModal">
                <x-slot name="title">Delete Workout?</x-slot>
                <x-slot name="content">Are you sure you want to delete this workout? This cannot be
                    undone.
                </x-slot>
                <x-slot name="footer">
                    <x-button.tertiary wire:click="$toggle('showConfirmDeleteWorkoutModal')">
                        Cancel
                    </x-button.tertiary>
                    <x-button.danger wire:click="destroyWorkout({{ $workout->id }})">
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
