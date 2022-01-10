<div>
    @can('admin')
    <x-flash/>
{{--    <x-slot name="header">--}}
{{--        <x-headings.page>--}}
{{--            Users--}}
{{--            <x-slot name="action">--}}
{{--                <x-search/>--}}
{{--            </x-slot>--}}
{{--        </x-headings.page>--}}
{{--    </x-slot>--}}

    <x-headings.page>
        Users
        <x-slot name="action">
            <x-search/>
        </x-slot>
    </x-headings.page>

    <div class="flex flex-col space-y-4">
        <x-table.table class="table-fixed relative">
            <x-slot name="head">
                <x-table.header-row class="">

                    <x-table.heading sortable
                                     wire:click="sortBy('name')"
                                     :direction="$sortField === 'name' ? $sortDirection : null"
                                     class="w-11/12 lg:w-3/12"
                    >
                        Username
                    </x-table.heading>
                    <x-table.heading sortable
                                     wire:click="sortBy('email')"
                                     :direction="$sortField === 'email' ? $sortDirection : null"
                                     class="hidden lg:inline-block lg:w-3/12"
                    >
                    email
                </x-table.heading>
                    <x-table.heading sortable
                                     wire:click="sortBy('')"
                                     :direction="$sortField === 'role' ? $sortDirection : null"
                                     class="hidden lg:inline-block lg:w-3/12"
                    >
                        Role
                    </x-table.heading>
                </x-table.header-row>
            </x-slot>

            <x-slot name="body">
                @forelse($users as $user)
                    <x-table.row
                        wire:key="{{ $loop->index }}"
                        x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                        wire:loading.class.delay="opacity-50"
                    >
                        <x-table.cell class="w-11/12 lg:w-3/12">
                            <a href="{{ $user->path() }}" class="hover:underline hover:font-bold">
                                {{ $user->name }}
                            </a>
                        </x-table.cell>
                        <x-table.cell class="hidden lg:inline-block lg:w-3/12">{{ $user->email }}</x-table.cell>
                        <x-table.cell class="hidden lg:inline-block lg:w-3/12">{{ $user->role->name }}</x-table.cell>
                        <x-table.cell class="w-1/12 flex justify-end lg:px-2">
                            <x-dropdown.dropdown>
                                <x-slot name="trigger">
                                    <x-icon.dots-vertical class="text-gray-300 hover:text-red-800"/>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown.link href="{{ $user->path() }}">
                                        View Profile
                                    </x-dropdown.link>
                                    <div class="px-2">
                                        <hr>
                                    </div>
                                    <x-dropdown.link wire:click="editRecord({{ $user->id }})">
                                        Edit
                                    </x-dropdown.link>
                                    <x-dropdown.link wire:click="confirmDelete({{ $user->id }})">
                                        Delete
                                    </x-dropdown.link>
                                </x-slot>
                            </x-dropdown.dropdown>
                        </x-table.cell>
                    </x-table.row>

                    <x-modal.confirmation wire:model.defer="showConfirmModal">
                        <x-slot name="title">Delete User?</x-slot>
                        <x-slot name="content">Are you sure you want to delete this user? This cannot be
                            undone.
                        </x-slot>
                        <x-slot name="footer">
                            <x-button.tertiary wire:click="$toggle('showConfirmModal')">
                                Cancel
                            </x-button.tertiary>
                            <x-button.danger wire:click="destroy({{ $user->id }})" class="w-full">
                                Yes, Delete Athlete
                            </x-button.danger>
                        </x-slot>
                    </x-modal.confirmation>
                @empty
                    <x-table.row class="flex w-full">
                        <div class="flex flex-col items-center mx-auto">
                            <x-icon.user-group />
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No Users</h3>
                            <div class="mt-6">
                                <button type="button"
                                        wire:click="showFormModal"
                                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <x-icon.plus />
                                    Add User
                                </button>
                            </div>
                        </div>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table.table>
        <div>
            {{ $users->links() }}
        </div>
    </div>


    <x-modal.dialog wire:model.defer="showFormModal">
        <x-slot name="title">
            <div x-data="{editing: @entangle('editing')}">
                <span x-show="editing === true">Edit User</span>
                <span x-show="editing === false">Add an User</span>
            </div>

        </x-slot>

        <x-slot name="content">
{{--            <livewire:athletes.athlete-form/>--}}
        </x-slot>

        <x-slot name="footer">
            <div x-data="{editing: @entangle('editing')}" class="flex w-1/2 space-x-2">
                <x-button.tertiary wire:click="cancel">Cancel</x-button.tertiary>
                <x-button.primary wire:click="$emit('submitCreate')">
                    <span x-show="editing === true">Save</span>
                    <span x-show="editing === false">Create</span>
                </x-button.primary>
            </div>
        </x-slot>
    </x-modal.dialog>
@endcan
</div>
