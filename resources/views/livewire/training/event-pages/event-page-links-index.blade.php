<div>
    <x-link />
    <div class="flex justify-between items-center border-b-2 border-gray-200">
        <div class="flex w-full text-gray-500 text-2xl font-medium">
            Links
        </div>

        @can('coach')
            <button type="button" class="p-2 text-red-800 hover:text-red-600" wire:click="showFormModal">
                <x-icon.plus class="w-8 h-8 md:-mr-4" />
            </button>
        @endcan
    </div>

    <ul class="w-full py-2 space-y-2">
        @foreach($links as $link)
            <li class="flex w-full justify-between">
                <a class="text-gray-400 font-semibold hover:text-gray-200"
                   href="{{ $link->url }}">
                    {{ $link->text }}
                </a>
                @can('coach')
                    <x-dropdown.dropdown>
                        <x-slot name="trigger">
                            <x-icon.dots-vertical class="text-gray-300 hover:text-red-700 md:-mr-1" />
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown.link wire:click="edit({{ $link->id }})">
                                Edit
                            </x-dropdown.link>
                            <x-dropdown.link wire:click="confirmDelete({{ $link->id }})">
                                Delete
                            </x-dropdown.link>
                        </x-slot>
                    </x-dropdown.dropdown>
                @endcan
                <x-modal.confirmation wire:model.defer="showConfirmModal">
                    <x-slot name="title">Delete Link?</x-slot>
                    <x-slot name="content">Are you sure you want to delete this link?
                        This cannot be
                        undone.
                    </x-slot>
                    <x-slot name="footer">
                        <x-button.tertiary
                            wire:click="$toggle('showConfirmModal')">
                            Cancel
                        </x-button.tertiary>
                        <x-button.danger
                            wire:click="destroy({{ $link->id }})">
                            Yes, Delete Link
                        </x-button.danger>
                    </x-slot>
                </x-modal.confirmation>
            </li>
        @endforeach
    </ul>

    <x-modal.add-edit-record record-title="Link">
        <livewire:training.event-pages.event-page-link-form :eventSubtype="$eventSubtype" />
    </x-modal.add-edit-record>
</div>
