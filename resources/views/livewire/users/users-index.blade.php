<div>
    <x-flash />
    <x-flash />
    <x-headings.page>
        <x-slot name="breadcrumbs">
            <x-breadcrumb.menu>
                <x-breadcrumb.item href="{{ route('Dashboard') }}" :leadingArrow="false">Dashboard</x-breadcrumb.item>
            </x-breadcrumb.menu>
        </x-slot>
        Users
        <x-slot name="action">
            <x-search />
        </x-slot>
    </x-headings.page>
    <div class="flex">
        @include('partials._athletes-users-user-menu')

        <div class="flex flex-col space-y-4 w-full md:w-2/3 lg:w-3/4">
            <x-table.table class="table-fixed relative">
                <x-slot name="head">
                    <x-table.header-row class="">

                        <x-table.heading sortable
                                         wire:click="sortBy('name')"
                                         :direction="$sortField === 'name' ? $sortDirection : null"
                                         class="w-11/12 lg:w-4/12"
                        >
                            Username
                        </x-table.heading>
                        <x-table.heading sortable
                                         wire:click="sortBy('email')"
                                         :direction="$sortField === 'email' ? $sortDirection : null"
                                         class="hidden lg:inline-block lg:w-4/12"
                        >
                            email
                        </x-table.heading>
                        <x-table.heading class="hidden lg:inline-block lg:w-3/12">
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
                            <x-table.cell class="w-11/12 lg:w-4/12">
                                <div class="flex flex-col">
                                    <div>{{ $user->name }}</div>
                                    <div class="px-2 lg:hidden">{{ $user->email }}</div>
                                    <div class="px-2 lg:hidden">{{ $user->role->name }}</div>
                                </div>
                            </x-table.cell>
                            <x-table.cell class="hidden lg:inline-block lg:w-4/12">{{ $user->email }}</x-table.cell>
                            <x-table.cell
                                class="hidden lg:inline-block lg:w-3/12">{{ $user->role->name }}</x-table.cell>
                            <x-table.cell class="w-1/12 flex justify-end lg:px-2">
                                <x-dropdown.dropdown>
                                    <x-slot name="trigger">
                                        <x-icon.dots-vertical class="text-gray-300 hover:text-red-800" />
                                    </x-slot>
                                    <x-slot name="content">
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
                            <div class="flex flex-col items-center mx-auto mt-4">
                                <x-icon.emoji-sad class="h-10 w-10 text-gray-400" />
                                <h3 class="mt-2 text-sm font-medium text-gray-700 text-lg">No Users
                                    Found</h3>
                            </div>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table.table>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>

    @if($user)
        <x-modal.dialog wire:model.defer="showFormModal">
            <x-slot name="title">
                <div>
                    Edit User
                </div>
            </x-slot>

            <x-slot name="content">
                <livewire:users.users-form :user="$user" />
            </x-slot>

            <x-slot name="footer">
                <div class="flex w-1/2 space-x-2">
                    <x-button.tertiary wire:click="cancel">Cancel</x-button.tertiary>
                    <x-button.primary wire:click="$emit('submitCreate')">
                        <span>Save</span>
                    </x-button.primary>
                </div>
            </x-slot>
        </x-modal.dialog>
    @endif
</div>

