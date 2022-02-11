<div>
    <x-flash />
    <x-headings.page>
        Track Meets
        <x-slot name="action">
            <div class="flex items-center">
                <x-search />
            </div>
        </x-slot>
    </x-headings.page>

    <div class="flex">
        @include('partials._track-meet-properties-user-menu')

        <div class="flex flex-col space-y-4 w-full md:w-2/3 lg:w-3/4">
            <x-table.table class="table-fixed relative">
                <x-slot name="head">
                    <x-table.header-row class="">

                        <x-table.heading sortable
                                         wire:click="sortBy('meet_date')"
                                         :direction="$sortField === 'meet_date' ? $sortDirection : null"
                                         class="w-11/12 lg:w-4/12"
                        >
                            Date
                        </x-table.heading>

                        <x-table.heading class="hidden lg:inline-block lg:w-3/12">
                            Host
                        </x-table.heading>

                        <x-table.heading class="hidden lg:inline-block lg:w-3/12">
                            Venue
                        </x-table.heading>

                        <x-table.heading class="hidden lg:inline-block lg:w-1/12">
                            Page
                        </x-table.heading>

                        <x-table.heading class="w-1/12">
                            <x-button.plus />
                        </x-table.heading>
                    </x-table.header-row>
                </x-slot>

                <x-slot name="body">
                    @forelse($trackMeets as $trackMeet)
                        <x-table.expandable-row
                            wire:key="{{ $loop->index }}"
                            x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                            wire:loading.class.delay="opacity-50"
                        >
                            <x-slot name="unexpandedContent">
                                <x-table.cell class="w-11/12 lg:w-4/12">
                                    <div class="truncate pr-2">
                                        <a href="{{ $trackMeet->path() }}"
                                           class="font-semibold hover:underline hover:font-bold">
                                            {{ $trackMeet->meetName->name }}
                                        </a>
                                    </div>
                                    <div class="text-xs px-2 font-semibold text-gray-500">
                                        {{ $trackMeet->meet_date->format('n-d-Y') }}
                                    </div>

                                </x-table.cell>
                                <x-table.cell class="hidden lg:inline-block lg:w-3/12">
                                    {{ $trackMeet->host->name }}
                                </x-table.cell>
                                <x-table.cell class="hidden lg:inline-block lg:w-3/12">
                                    {{ $trackMeet->venue->name }}
                                </x-table.cell>
                                <x-table.cell class="hidden lg:inline-block lg:w-1/12">
                                    @if($trackMeet->teamResults)
                                        <a href="{{ $trackMeet->meet_page_url }}" class="hover:underline">Results</a>
                                    @elseif($trackMeet->meet_page_url)
                                        <a href="{{ $trackMeet->meet_page_url }}" class="hover:underline">Meet Info</a>
                                    @endif
                                </x-table.cell>
                                <x-table.cell class="hidden lg:flex lg:w-1/12 justify-end">
                                    <x-dropdown.dropdown>
                                        <x-slot name="trigger">
                                            <x-icon.dots-vertical class="text-gray-300 hover:text-red-700" />
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown.link href="{{ $trackMeet->path() }}">
                                                View Meet
                                            </x-dropdown.link>
                                            <div class="px-2">
                                                <hr>
                                            </div>
                                            <x-dropdown.link wire:click="editRecord({{ $trackMeet->id }})">
                                                Edit
                                            </x-dropdown.link>
                                            <x-dropdown.link wire:click="confirmDelete({{ $trackMeet->id }})">
                                                Delete
                                            </x-dropdown.link>
                                        </x-slot>
                                    </x-dropdown.dropdown>
                                </x-table.cell>
                            </x-slot>
                            <x-slot name="expandedContent">
                                <div class="flex text-xs px-2">
                                    <div class="flex flex-col text-gray-600">
                                        <div><span class="text-gray-400">Host: </span>{{ $trackMeet->host->name }}</div>
                                        <div><span class="text-gray-400">Venue: </span>{{ $trackMeet->venue->name }}</div>
                                        <div><span class="text-gray-400">Season: </span>{{ $trackMeet->season->name }}</div>
                                        <div><span class="text-gray-400">Timing: </span>{{ $trackMeet->timingMethod->name }}</div>
                                        @if( $trackMeet->meetResults )
                                            <div>
                                                <a href="{{ $trackMeet->meet_page_url }}">
                                                    <span class="text-gray-400">Results: </span>Results
                                                </a>
                                            </div>
                                        @elseif($trackMeet->meet_page_url)
                                            <div>
                                                <a href="{{ $trackMeet->meet_page_url }}">
                                                    <span class="text-gray-400">Page: </span>Meet Info
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                    <div class="flex justify-end px-8 space-x-2 items-center">
                                        <x-button.edit />
                                        <x-button.delete />
                                    </div>
                            </x-slot>


                        </x-table.expandable-row>
                        @include('livewire.meets._confirm-delete-track-meet-modal')

                    @empty
                        <x-table.row class="flex w-full">
                            <div class="flex flex-col items-center mx-auto">
                                <x-icon.user-group />
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No Track Meets</h3>
                                <div class="mt-6">
                                    <button type="button"
                                            wire:click="showFormModal"
                                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <x-icon.plus />
                                        Add Track Meet
                                    </button>
                                </div>
                            </div>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>
    </div>

    <x-modal.add-edit-record record-title="Track Meet">
        <livewire:meets.track-meet-form />
    </x-modal.add-edit-record>
</div>
