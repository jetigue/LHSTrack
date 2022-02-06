<div>
    <x-flash />
    <x-headings.page>
        <x-slot name="breadcrumbs">
            <x-breadcrumb.menu>
                <x-breadcrumb.item href="{{ route('Dashboard') }}" :leadingArrow="false">Dashboard</x-breadcrumb.item>
            </x-breadcrumb.menu>
        </x-slot>
        Race Levels
    </x-headings.page>
    <div class="flex">
        @include('partials._track-meet-properties-user-menu')
        <div class="flex flex-col space-y-4 w-full md:w-2/3 lg:w-3/4">
            <x-table.table class="table-fixed relative">
                <x-slot name="head">
                    <x-table.header-row class="">

                        <x-table.heading class="w-11/12">
                            Race Level
                        </x-table.heading>

                        <x-table.heading class="w-1/12">
                            <x-button.plus />
                        </x-table.heading>

                    </x-table.header-row>
                </x-slot>

                <x-slot name="body">
                    @forelse($levels as $level)
                        <x-table.row
                            wire:key="{{ $loop->index }}"
                            x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                            wire:loading.class.delay="opacity-50"
                        >
                            <x-table.cell class="w-11/12">
                                {{ $level->name }}
                            </x-table.cell>
                            <x-table.cell class="w-1/12 flex justify-end">
                                <x-dropdown.dropdown>
                                    <x-slot name="trigger">
                                        <x-icon.dots-vertical class="text-gray-300 hover:text-red-700" />
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown.link wire:click="editRecord({{ $level->id }})">
                                            Edit
                                        </x-dropdown.link>
                                        <x-dropdown.link wire:click="confirmDelete({{ $level->id }})">
                                            Delete
                                        </x-dropdown.link>
                                    </x-slot>
                                </x-dropdown.dropdown>
                            </x-table.cell>
                        </x-table.row>

                        <x-modal.confirmation wire:model.defer="showConfirmModal">
                            <x-slot name="title">Delete Level?</x-slot>
                            <x-slot name="content">Are you sure you want to delete this level? This cannot be
                                undone.
                            </x-slot>
                            <x-slot name="footer">
                                <x-button.tertiary wire:click="$toggle('showConfirmModal')">
                                    Cancel
                                </x-button.tertiary>
                                <x-button.danger wire:click="destroy({{ $level->id }})">
                                    Yes, Delete Level
                                </x-button.danger>
                            </x-slot>
                        </x-modal.confirmation>
                    @empty
                        <x-table.row class="flex w-full">
                            <x-no-records missing-record="Level" />
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>
    </div>

    <x-modal.add-edit-record record-title="Level">
        <livewire:properties.races.level-form />
    </x-modal.add-edit-record>

</div>
