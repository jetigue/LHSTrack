<div>
    <x-flash />
    <x-headings.page>
        <x-slot name="breadcrumbs">
            <x-breadcrumb.menu>
                <x-breadcrumb.item href="{{ route('Dashboard') }}" :leadingArrow="false">Dashboard</x-breadcrumb.item>
            </x-breadcrumb.menu>
        </x-slot>
        Track Venues
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
                                         wire:click="sortBy('name')"
                                         :direction="$sortField === 'last_name' ? $sortDirection : null"
                                         class="w-11/12 lg:w-6/12"
                        >
                            Meet Name
                        </x-table.heading>
                        <x-table.heading class="hidden lg:inline-block lg:w-5/12">
                            Surface
                        </x-table.heading>

                        <x-table.heading class="w-1/12">
                            <x-button.plus />
                        </x-table.heading>
                    </x-table.header-row>
                </x-slot>

                <x-slot name="body">
                    @forelse($trackVenues as $trackVenue)
                        <x-table.row
                            wire:key="{{ $loop->index }}"
                            x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                            wire:loading.class.delay="opacity-50"
                        >
                            <x-table.cell class="w-11/12 lg:w-6/12">
                                <a href="{{ $trackVenue->path() }}" class="hover:underline hover:font-bold">
                                    {{ $trackVenue->name }}
                                </a>
                            </x-table.cell>
                            <x-table.cell class="hidden lg:inline-block lg:w-5/12">
                                {{ $trackVenue->surface->name }}
                            </x-table.cell>
                            <x-table.cell class="w-1/12 flex justify-end">
                                <x-dropdown.dropdown>
                                    <x-slot name="trigger">
                                        <x-icon.dots-vertical class="text-gray-300 hover:text-red-700" />
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown.link wire:click="editRecord({{ $trackVenue->id }})">
                                            Edit
                                        </x-dropdown.link>
                                        <x-dropdown.link wire:click="confirmDelete({{ $trackVenue->id }})">
                                            Delete
                                        </x-dropdown.link>
                                    </x-slot>
                                </x-dropdown.dropdown>
                            </x-table.cell>
                        </x-table.row>

                        <x-modal.confirmation wire:model.defer="showConfirmModal">
                            <x-slot name="title">Delete Track Venue?</x-slot>
                            <x-slot name="content">Are you sure you want to delete this venue? This cannot be
                                undone.
                            </x-slot>
                            <x-slot name="footer">
                                <x-button.tertiary wire:click="$toggle('showConfirmModal')">
                                    Cancel
                                </x-button.tertiary>
                                <x-button.danger wire:click="destroy({{ $trackVenue->id }})">
                                    Yes, Delete Meet Name
                                </x-button.danger>
                            </x-slot>
                        </x-modal.confirmation>
                    @empty
                        <x-table.row class="flex w-full">
                            <x-no-records missing-record="Track Venue" />
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table.table>

            <div class="text-gray-300">
                {{ $trackVenues->links() }}
            </div>
        </div>
    </div>

    <x-modal.add-edit-record record-title="Track Venue">
        <livewire:properties.meets.track.track-venue-form />
    </x-modal.add-edit-record>

</div>
