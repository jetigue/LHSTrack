<div>
    <x-flash />
    <div class="flex flex-col w-full">
        <x-headings.section>
            {{ $this->teamResult->division->name }} {{ $trackEvent->name }} Results
        </x-headings.section>

        <x-table.table class="table-fixed relative">
            <x-slot name="head">
                <x-table.header-row class="flex">

                    <x-table.heading class="hidden md:flex md:w-2/12">
                        Place
                    </x-table.heading>

                    <x-table.heading class="w-7/12 md:flex md:w-4/12 lg:w-3/12">
                        Athlete
                    </x-table.heading>

                    <x-table.heading class="w-4/12 md:flex md:w-3/12 lg:w-2/12">
                        Mark
                    </x-table.heading>

                    <x-table.heading class="hidden lg:flex lg:w-2/12">
                        Flight
                    </x-table.heading>

                    <x-table.heading class="hidden md:flex md:w-2/12">
                        Points
                    </x-table.heading>

                    <x-table.heading class="flex w-1/12">
                        @can('coach')
                            <x-button.plus />
                        @endcan
                    </x-table.heading>

                </x-table.header-row>
            </x-slot>

            <x-slot name="body">
                @forelse($results as $result)
                    <x-table.row
                        wire:key="{{ $loop->index }}"
                        x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                        wire:loading.class.delay="opacity-50"
                    >
                        <x-table.cell class="hidden md:flex md:w-2/12">
                            {{ $result->place_with_suffix }}
                        </x-table.cell>

                        <x-table.cell class="flex w-7/12 md:w-4/12 lg:w-3/12">
                            <a href="{{ $result->athlete->path() }}" class="hover:underline">
                                {{ $result->athlete->fullName }}
                            </a>
                        </x-table.cell>

                        <x-table.cell class="flex w-4/12 md:w-3/12 lg:w-2/12 items-baseline">
                            {{ $result->mark }}
                            <span class="text-xs">
                                {{$result->fraction }}
                            </span>
                            "
                        </x-table.cell>
                        <x-table.cell class="hidden lg:flex lg:w-2/12">
                            {{ $result->flight }}
                        </x-table.cell>

                        <x-table.cell class="hidden md:flex md:w-2/12">
                            {{ $result->points }}
                        </x-table.cell>
                        <x-table.cell class="flex w-1/12 justify-end">
                            @can('coach')
                                <x-dropdown.dropdown>
                                    <x-slot name="trigger">
                                        <x-icon.dots-vertical class="text-gray-300 hover:text-red-700" />
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown.link wire:click="editRecord({{ $result->id }})">
                                            Edit
                                        </x-dropdown.link>
                                        <x-dropdown.link wire:click="confirmDelete({{ $result->id }})">
                                            Delete
                                        </x-dropdown.link>
                                    </x-slot>
                                </x-dropdown.dropdown>
                            @endcan
                        </x-table.cell>
                    </x-table.row>

                    <x-modal.confirmation wire:model.defer="showConfirmModal">
                        <x-slot name="title">Delete Result?</x-slot>
                        <x-slot name="content">Are you sure you want to delete this result? This cannot be
                            undone.
                        </x-slot>
                        <x-slot name="footer">
                            <x-button.tertiary wire:click="$toggle('showConfirmModal')">
                                Cancel
                            </x-button.tertiary>
                            <x-button.danger wire:click="destroy({{ $result->id }})">
                                Yes, Delete Result
                            </x-button.danger>
                        </x-slot>
                    </x-modal.confirmation>
                @empty
                    <x-table.row class="flex w-full">
                        <x-no-records missing-record="Result" />
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table.table>
    </div>

    <x-modal.add-edit-record record-title="{{ $trackEvent->name }} Result">
        <livewire:meets.track.results.field-event-result-form
            :teamResult="$teamResult"
            :trackEvent="$trackEvent" />
    </x-modal.add-edit-record>
</div>
