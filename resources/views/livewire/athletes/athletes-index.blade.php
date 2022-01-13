<div>
    @can('coach')
    <x-flash />
    <x-headings.page>
        Athletes
        <x-slot name="action">
            <div class="flex items-end space-x-2">
                <x-button.primary wire:click="export">Export</x-button.primary>
                <x-search />
            </div>
        </x-slot>
    </x-headings.page>
    <div class="flex flex-col space-y-4">
        <x-table.table class="table-fixed relative">
            <x-slot name="head">
                <x-table.header-row>

                    <x-table.heading sortable
                                     wire:click="sortBy('last_name')"
                                     :direction="$sortField === 'last_name' ? $sortDirection : null"
                                     class="w-11/12 lg:w-3/12"
                    >
                        Name
                    </x-table.heading>

                    <x-table.heading class="hidden lg:flex lg:w-2/12">
                        Username
                    </x-table.heading>

                    <x-table.heading sortable
                                     wire:click="sortBy('primary_event')"
                                     :direction="$sortField === 'primary_events' ? $sortDirection : null"
                                     class="hidden lg:flex lg:w-2/12"
                    >
                        Primary Events
                    </x-table.heading>

                    <x-table.heading sortable
                                     wire:click="sortBy('grad_year')"
                                     :direction="$sortField === 'grad_year' ? $sortDirection : null"
                                     class="hidden lg:flex lg:w-2/12"
                    >
                        Class
                    </x-table.heading>

                    <x-table.heading sortable
                                     wire:click="sortBy('status')"
                                     :direction="$sortField === 'status' ? $sortDirection : null"
                                     class="hidden lg:flex lg:w-2/12"
                    >
                        Status
                    </x-table.heading>
                    <x-table.heading class="flex w-1/12">
                        <div class="absolute z-20 lg:px-2 top-3 md:top-4 lg:top-6 right-1 md:right-3 lg:right-5">
                            <x-dropdown.dropdown>
                                <x-slot name="trigger">
                                    <x-icon.plus class="text-red-800 h-7 w-7" />
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown.link wire:click="showFormModal">
                                        Add an Athlete
                                    </x-dropdown.link>
                                    <x-dropdown.link wire:click="$emit('showImportModal')">
                                        Import Athletes
                                    </x-dropdown.link>
                                </x-slot>
                            </x-dropdown.dropdown>
                        </div>
                    </x-table.heading>
                </x-table.header-row>
            </x-slot>

            <x-slot name="body">
                @forelse($athletes as $athlete)
                    <x-table.row
                        wire:key="{{ $loop->index }}"
                        x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                        wire:loading.class.delay="opacity-50"
                    >
                        <x-table.cell class="w-11/12 lg:w-3/12">
                            <a href="{{ $athlete->path() }}" class="hover:underline hover:font-bold">
                                {{ $athlete->last_name }}, {{ $athlete->first_name }}
                            </a>
                        </x-table.cell>
                        <x-table.cell class="hidden lg:flex lg:w-2/12">
                            @if($athlete->user)
                                {{ $athlete->user->name }}
                            @endif
                        </x-table.cell>
                        <x-table.cell
                            class="hidden lg:flex lg:w-2/12">
                            @if($athlete->primaryTrackEvent)
                                {{ $athlete->primaryTrackEvent->name }}
                            @endif
                        </x-table.cell>

                        <x-table.cell class="hidden lg:flex lg:w-2/12">
                            {{ $athlete->grad_year }}
                        </x-table.cell>

                        <x-table.cell
                            class="hidden lg:inline-block lg:w-2/12 text-{{ $athlete->status_color }}-500">
                            {{ $athlete->current_status }}
                        </x-table.cell>
                        <x-table.cell class="w-1/12 flex justify-end lg:px-2">
                            <x-dropdown.dropdown>
                                <x-slot name="trigger">
                                    <x-icon.dots-vertical class="text-gray-300 hover:text-indigo-500" />
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown.link href="{{ $athlete->path() }}">
                                        View Profile
                                    </x-dropdown.link>
                                    <div class="px-2">
                                        <hr>
                                    </div>
                                    @can('admin')
                                    <x-dropdown.link wire:click="linkAthlete({{ $athlete->id }})">
                                        Link to User
                                    </x-dropdown.link>
                                    @endcan
                                    <x-dropdown.link wire:click="editRecord({{ $athlete->id }})">
                                        Edit
                                    </x-dropdown.link>
                                    <x-dropdown.link wire:click="confirmDelete({{ $athlete->id }})">
                                        Delete
                                    </x-dropdown.link>
                                </x-slot>
                            </x-dropdown.dropdown>
                        </x-table.cell>
                    </x-table.row>

                    @include('livewire.athletes._confirm-delete-modal')
                @empty
                    <x-table.row class="flex w-full">
                        <div class="flex flex-col items-center mx-auto">
                            <x-icon.user-group />
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No Athletes</h3>
                            <div class="mt-6">
                                <button type="button"
                                        wire:click="showFormModal"
                                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <x-icon.plus />
                                    Add Athlete
                                </button>
                            </div>
                        </div>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table.table>


        <div class="text-gray-500">
            {{ $athletes->links() }}
        </div>
    </div>

    <livewire:athletes.import-athletes />
    @include('livewire.athletes._athlete-form-modal')

@if($athlete)
        <x-modal.dialog wire:model.defer="showLinkModal">
            <x-slot name="title">
                <div>
                    Link Athlete
                </div>
            </x-slot>

            <x-slot name="content">
                <livewire:athletes.link-athlete-form />
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-end space-x-2">
                    <x-button.tertiary wire:click="cancel">Cancel</x-button.tertiary>
                    <x-button.primary wire:click="$emit('linkSubmitted')">Link Athlete</x-button.primary>
                </div>
            </x-slot>
        </x-modal.dialog>
    @endif
@endif

</div>
