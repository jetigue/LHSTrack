<div>
    <x-flash />
    <div class="flex flex-col w-full">
        <x-headings.section>
            Team Results
        </x-headings.section>

        <x-table.table class="table-fixed relative">
            <x-slot name="head">
                <x-table.header-row class="inline-block">
                    <x-table.heading class="w-11/12 md:w-3/12">
                        Division
                    </x-table.heading>

                    <x-table.heading class="hidden md:inline-block md:w-2/12">
                        Place
                    </x-table.heading>

                    <x-table.heading class="hidden md:inline-block md:w-2/12">
                        Points
                    </x-table.heading>

                    <x-table.heading class="hidden md:inline-block md:2/12">
                        Notes
                    </x-table.heading>

                    <x-table.heading class="flex w-1/12">
                        <x-button.plus />
                    </x-table.heading>

                </x-table.header-row>
            </x-slot>

            <x-slot name="body">
                @forelse($teamResults as $result)
                    <x-table.row
                        wire:key="{{ $loop->index }}"
                        x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                        wire:loading.class.delay="opacity-50"
                    >
                        <x-table.cell class="w-11/12 md:w-3/12">
                            {{ $result->division->name }}
                        </x-table.cell>
                        <x-table.cell class="hidden md:inline-block md:w-2/12">
                            {{ $result->place_with_suffix }} <span class="text-gray-400 text-xs pl-2"> ({{ $result->number_teams }} Teams)</span>
                        </x-table.cell>
                        <x-table.cell class="hidden md:inline-block md:w-2/12">
                            {{$result->points}}
                        </x-table.cell>
                        <x-table.cell x-cloak class="hidden md:inline-block flex-wrap md:w-2/12 cursor-pointer"
                                      x-data="{ expand: false }"
                        >
                            <span x-show="!expand"
                                  @click="expand = true"
                                  class="line-clamp-1 hover:underline">
                                {{ $result->notes }}
                            </span>
                            <div x-show="expand" class="flex flex-col justify-start">
                                {{ $result->notes }}
                            <button
                                type="button"
                                @click="expand = false"
                                class="text-sm text-gray-400 text-left hover:text-red-700 font-semibold"
                            >
                                Hide
                            </button>
                            </div>
                        </x-table.cell>
                        <x-table.cell class="hidden md:inline-block md:w-2/12 text-center">
                            <a href="{{ $result->path() }}">Results</a>
                        </x-table.cell>
                        <x-table.cell class="flex w-1/12 justify-end">
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

    <x-modal.add-edit-record record-title="Team Result">
        <livewire:meets.track.results.team-result-form :trackMeet="$trackMeet" />
    </x-modal.add-edit-record>
</div>
