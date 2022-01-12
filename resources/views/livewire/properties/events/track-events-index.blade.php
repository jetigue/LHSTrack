<div>
    <x-flash />
    <x-headings.page>
        <x-slot name="breadcrumbs">
            <x-breadcrumb.menu>
                <x-breadcrumb.item href="{{ route('Dashboard') }}" :leadingArrow="false">Dashboard</x-breadcrumb.item>
            </x-breadcrumb.menu>
        </x-slot>
        Track Events
    </x-headings.page>

    <div class="flex flex-col space-y-4">
        <x-table.table class="table-fixed relative">
            <x-slot name="head">
                <x-table.header-row class="">

                    <x-table.heading class="w-11/12 lg:w-6/12">
                        Event Name
                    </x-table.heading>
                    <x-table.heading class="hidden lg:inline-block lg:w-5/12">
                        Category
                    </x-table.heading>

                    <x-table.heading class="w-1/12">
                        <div class="absolute z-20 lg:px-2 top-6 right-5">
                            <x-button.add />
                        </div>
                    </x-table.heading>
                </x-table.header-row>
            </x-slot>

            <x-slot name="body">
                @forelse($trackEvents as $trackEvent)
                    <x-table.row
                        wire:key="{{ $loop->index }}"
                        x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                        wire:loading.class.delay="opacity-50"
                    >
                        <x-table.cell class="w-11/12 lg:w-6/12">
                            {{ $trackEvent->name }}
                        </x-table.cell>
                        <x-table.cell class="hidden lg:inline-block lg:w-5/12">
                                {{ $trackEvent->category->name }}
                        </x-table.cell>
                        <x-table.cell class="w-1/12 flex justify-end lg:px-2">
                            <x-dropdown.dropdown>
                                <x-slot name="trigger">
                                    <x-icon.dots-vertical class="text-gray-300 hover:text-indigo-500" />
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown.link wire:click="editRecord({{ $trackEvent->id }})">
                                        Edit
                                    </x-dropdown.link>
                                    <x-dropdown.link wire:click="confirmDelete({{ $trackEvent->id }})">
                                        Delete
                                    </x-dropdown.link>
                                </x-slot>
                            </x-dropdown.dropdown>
                        </x-table.cell>
                    </x-table.row>

                    <x-modal.confirmation wire:model.defer="showConfirmModal">
                        <x-slot name="title">Delete Track Event?</x-slot>
                        <x-slot name="content">Are you sure you want to delete this event? This cannot be
                            undone.
                        </x-slot>
                        <x-slot name="footer">
                            <x-button.tertiary wire:click="$toggle('showConfirmModal')">
                                Cancel
                            </x-button.tertiary>
                            <x-button.danger wire:click="destroy({{ $trackEvent->id }})">
                                Yes, Delete Event
                            </x-button.danger>
                        </x-slot>
                    </x-modal.confirmation>
                @empty
                    <x-table.row class="flex w-full">
                        <div class="flex flex-col items-center mx-auto">
                            <x-icon.user-group />
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No Events</h3>
                            <div class="mt-6">
                                <button type="button"
                                        wire:click="showFormModal"
                                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <x-icon.plus />
                                    Add a Track Event
                                </button>
                            </div>
                        </div>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table.table>
    </div>

    <x-modal.dialog wire:model.defer="showFormModal">
        <x-slot name="title">
            <div x-data="{editing: @entangle('editing')}">
                <span x-show="editing === true">Edit Event</span>
                <span x-show="editing === false">Add a Event</span>
            </div>

        </x-slot>

        <x-slot name="content">
            <livewire:properties.events.track-event-form />
        </x-slot>

        <x-slot name="footer">
            <div x-data="{editing: @entangle('editing')}" class="flex justify-end space-x-2">
                <x-button.tertiary wire:click="cancel">Cancel</x-button.tertiary>
                <x-button.primary wire:click="$emit('submitCreate')">
                    <span x-show="editing === true">Save</span>
                    <span x-show="editing === false">Create</span>
                </x-button.primary>
            </div>
        </x-slot>
    </x-modal.dialog>
</div>
