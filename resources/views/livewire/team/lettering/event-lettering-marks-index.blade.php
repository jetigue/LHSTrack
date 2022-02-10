<div>

    <x-table.table class="table-fixed relative">
        <x-slot name="head">
            <x-table.header-row class="flex w-full items-baseline">

                <x-table.heading class="flex w-full md:w-3/12">
                    Event
                </x-table.heading>

                <x-table.heading class="hidden md:flex md:w-2/12 justify-center">
                    9th Grade
                </x-table.heading>

                <x-table.heading class="hidden md:flex md:w-2/12 justify-center">
                    10th Grade
                </x-table.heading>

                <x-table.heading class="hidden md:flex md:w-2/12 justify-center">
                    11th Grade
                </x-table.heading>

                <x-table.heading class="hidden md:flex md:w-2/12 justify-center">
                    12th Grade
                </x-table.heading>

                <x-table.heading class="flex w-1/12 justify-end">
                    @can('coach')
                        <x-dropdown.dropdown width="72">
                            <x-slot name="trigger">
                                <x-icon.plus class="h-7 w-7 text-red-700 -mb-2 -mr-1" />
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown.link wire:click="addRunningEventStandard">
                                    + Running Event Standard
                                </x-dropdown.link>
                                <x-dropdown.link wire:click="addFieldEventStandard">
                                    + Field Event Standard
                                </x-dropdown.link>
                            </x-slot>
                        </x-dropdown.dropdown>
                    @endcan
                </x-table.heading>

            </x-table.header-row>
        </x-slot>

        <x-slot name="body">
            @foreach($runningStandards->sortBy('trackEvent.distance_in_meters') as $runningStandard)
                <x-table.row
                    wire:key="{{ $loop->index }}"
                    x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                    wire:loading.class.delay="opacity-50"
                >
                    <x-table.cell class="flex md:w-3/12">
                        {{ $runningStandard->trackEvent->name }}
                    </x-table.cell>

                    <x-table.cell class="hidden md:flex md:w-2/12 items-baseline justify-center">
                        {{ ltrim($runningStandard->freshmanTime, 0) }}
                        <span
                            class="text-xs text-gray-600">
                            @if($runningStandard->freshman_milliseconds > 0)
                                .{{ $runningStandard->freshman_milliseconds }}
                                @endif
                        </span>
                    </x-table.cell>

                    <x-table.cell class="hidden md:flex md:w-2/12 items-baseline justify-center">
                        {{ ltrim($runningStandard->sophomoreTime, 0) }}
                        <span
                            class="text-xs text-gray-600">
                            @if($runningStandard->sophomore_milliseconds > 0)
                                .{{ $runningStandard->sophomore_milliseconds }}
                                @endif
                        </span>
                    </x-table.cell>

                    <x-table.cell class="hidden md:flex md:w-2/12 items-baseline justify-center">
                        {{ ltrim($runningStandard->juniorTime, 0) }}
                        <span
                            class="text-xs text-gray-600">
                            @if($runningStandard->junior_milliseconds > 0)
                                .{{ $runningStandard->junior_milliseconds }}
                        @endif
                        </span>
                    </x-table.cell>

                    <x-table.cell class="hidden md:flex md:w-2/12 items-baseline justify-center">
                        {{ ltrim($runningStandard->seniorTime, 0) }}
                        <span
                            class="text-xs text-gray-600">
                            @if($runningStandard->senior_milliseconds > 0)
                                .{{ $runningStandard->senior_milliseconds }}
                                @endif
                        </span>
                    </x-table.cell>

                    <x-table.cell class="flex w-1/12 justify-end">
                        @can('coach')
                            <x-dropdown.dropdown>
                                <x-slot name="trigger">
                                    <x-icon.dots-vertical class="text-gray-300 hover:text-red-700" />
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown.link wire:click="editRunningStandard({{ $runningStandard->id }})">
                                        Edit
                                    </x-dropdown.link>
                                    <x-dropdown.link wire:click="confirmDeleteRunningStandard({{ $runningStandard->id }})">
                                        Delete
                                    </x-dropdown.link>
                                </x-slot>
                            </x-dropdown.dropdown>
                        @endcan
                    </x-table.cell>
                </x-table.row>

                <x-modal.confirmation wire:model.defer="showConfirmModal">
                    <x-slot name="title">Delete Standard?</x-slot>
                    <x-slot name="content">Are you sure you want to delete this standard? This cannot be
                        undone.
                    </x-slot>
                    <x-slot name="footer">
                        <x-button.tertiary wire:click="$toggle('showConfirmModal')">
                            Cancel
                        </x-button.tertiary>
                        <x-button.danger wire:click="destroy({{ $runningStandard->id }})">
                            Yes, Delete Standard
                        </x-button.danger>
                    </x-slot>
                </x-modal.confirmation>
{{--            @empty--}}
{{--                <div class="flex flex-col items-center mx-auto mt-4">--}}
{{--                    <x-icon.emoji-sad class="h-10 w-10 text-gray-400" />--}}
{{--                    <h3 class="mt-2 text-sm font-medium text-gray-700 text-lg">No Standards Found</h3>--}}
{{--                </div>--}}
            @endforeach
            @foreach($fieldEventStandards as $fieldEventStandard)
                    <x-table.row
                        wire:key="{{ $loop->index }}"
                        x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                        wire:loading.class.delay="opacity-50"
                    >
                        <x-table.cell class="flex md:w-3/12">
                            {{ $fieldEventStandard->trackEvent->name }}
                        </x-table.cell>

                        <x-table.cell class="hidden md:flex md:w-2/12 items-baseline justify-center">
                            {{ $fieldEventStandard->freshmanMark }}
                            <span class="text-xs">
                                {{$fieldEventStandard->freshmanFraction }}
                            </span>
                            "
                        </x-table.cell>

                        <x-table.cell class="hidden md:flex md:w-2/12 items-baseline justify-center">
                            {{ $fieldEventStandard->sophomoreMark }}
                            <span class="text-xs">
                                {{$fieldEventStandard->sophomoreFraction }}
                            </span>
                            "
                        </x-table.cell>

                        <x-table.cell class="hidden md:flex md:w-2/12 items-baseline justify-center">
                            {{ $fieldEventStandard->juniorMark }}
                            <span class="text-xs">
                                {{$fieldEventStandard->juniorFraction }}
                            </span>
                            "
                        </x-table.cell>

                        <x-table.cell class="hidden md:flex md:w-2/12 items-baseline justify-center">
                            {{ $fieldEventStandard->seniorMark }}
                            <span class="text-xs">
                                {{$fieldEventStandard->seniorFraction }}
                            </span>
                            "
                        </x-table.cell>

                        <x-table.cell class="flex w-1/12 justify-end">
                            @can('coach')
                                <x-dropdown.dropdown>
                                    <x-slot name="trigger">
                                        <x-icon.dots-vertical class="text-gray-300 hover:text-red-700" />
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown.link wire:click="editFieldEventStandard({{ $fieldEventStandard->id }})">
                                            Edit
                                        </x-dropdown.link>
                                        <x-dropdown.link wire:click="confirmDeleteFieldStandard({{ $fieldEventStandard->id }})">
                                            Delete
                                        </x-dropdown.link>
                                    </x-slot>
                                </x-dropdown.dropdown>
                            @endcan
                        </x-table.cell>
                    </x-table.row>

                    <x-modal.confirmation wire:model.defer="showConfirmModal">
                        <x-slot name="title">Delete Standard?</x-slot>
                        <x-slot name="content">Are you sure you want to delete this standard? This cannot be
                            undone.
                        </x-slot>
                        <x-slot name="footer">
                            <x-button.tertiary wire:click="$toggle('showConfirmModal')">
                                Cancel
                            </x-button.tertiary>
                            <x-button.danger wire:click="destroy({{ $runningStandard->id }})">
                                Yes, Delete Standard
                            </x-button.danger>
                        </x-slot>
                    </x-modal.confirmation>
            @endforeach
        </x-slot>
    </x-table.table>

    @if ($addingRunningEvent)
        <x-modal.add-edit-record record-title="{{ $gender->name }} Time Standard">
            <livewire:team.lettering.running-event-lettering-time-form :gender="$gender" />
        </x-modal.add-edit-record>
        @elseif ($addingFieldEvent)
            <x-modal.add-edit-record record-title="{{ $gender->name }} Lettering Mark">
            <livewire:team.lettering.field-event-lettering-mark-form :gender="$gender" />
        </x-modal.add-edit-record>
    @endif
</div>
