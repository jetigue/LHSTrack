<div>
    <x-flash />
    <x-headings.page>
        Athletes
        <x-slot name="action">
            <div class="flex space-x-2 items-center">
                <x-search />
                <div class="pt-4">
                    <livewire:athletes.import-athletes />
                </div>

            </div>
        </x-slot>
    </x-headings.page>
    <div class="flex flex-col space-y-4 mt-4">
        <x-table.table class="table-fixed relative">
            <x-slot name="head">
                <x-table.header-row class="">

                    <x-table.heading sortable
                                     wire:click="sortBy('last_name')"
                                     :direction="$sortField === 'last_name' ? $sortDirection : null"
                                     class="w-11/12 lg:w-3/12"
                    >
                        Name
                    </x-table.heading>
                    <x-table.heading sortable
                                     wire:click="sortBy('sex')"
                                     :direction="$sortField === 'sex' ? $sortDirection : null"
                                     class="hidden lg:inline-block lg:w-2/12"
                    >
                        Sex
                    </x-table.heading>
                    <x-table.heading sortable
                                     wire:click="sortBy('grad_year')"
                                     :direction="$sortField === 'grad_year' ? $sortDirection : null"
                                     class="hidden lg:inline-block lg:w-2/12"
                    >
                        Class
                    </x-table.heading>
                    <x-table.heading sortable
                                     wire:click="sortBy('dob')"
                                     :direction="$sortField === 'dob' ? $sortDirection : null"
                                     class="hidden lg:inline-block lg:w-2/12"
                    >
                        DOB
                    </x-table.heading>
                    <x-table.heading sortable
                                     wire:click="sortBy('physical_expiration_date')"
                                     :direction="$sortField === 'physical_expiration_date' ? $sortDirection : null"
                                     class="hidden lg:inline-block lg:w-2/12"
                    >
                        Physical
                    </x-table.heading>
                    <x-table.heading sortable
                                     wire:click="sortBy('status')"
                                     :direction="$sortField === 'status' ? $sortDirection : null"
                                     class="hidden lg:inline-block lg:w-1/12"
                    >
                        Status
                    </x-table.heading>
                    <x-table.heading class="w-1/12">
                        <div class="absolute z-20 lg:px-2 top-6 right-5">
                            <x-button.add />
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
                        <x-table.cell class="hidden lg:inline-block lg:w-2/12">
                            {{ $athlete->sex_for_humans }}
                        </x-table.cell>
                        <x-table.cell class="hidden lg:inline-block lg:w-2/12">
                            {{ $athlete->grad_year }}
                        </x-table.cell>
                        <x-table.cell
                            class="hidden lg:inline-block lg:w-2/12">
                            {{ $athlete->birthdate_for_humans }}
                        </x-table.cell>
                        <x-table.cell
                            class="hidden lg:inline-block lg:w-2/12">
                            {{ $athlete->physical_expiration_date_for_humans }}
                        </x-table.cell>
                        <x-table.cell
                            class="hidden lg:inline-block lg:w-1/12 text-{{ $athlete->status_color }}-500">
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


        <div class="text-gray-300">
            {{ $athletes->links() }}
        </div>
    </div>


@include('livewire.athletes._athlete-form-modal')
</div>
