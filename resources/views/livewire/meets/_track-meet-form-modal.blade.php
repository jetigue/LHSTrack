<x-modal.dialog wire:model.defer="showFormModal">
    <x-slot name="title">
        <div x-data="{editing: @entangle('editing')}">
            <span x-show="editing === true">Edit Track Meet</span>
            <span x-show="editing === false">Add a Track Meet</span>
        </div>

    </x-slot>

    <x-slot name="content">
        <livewire:meets.track-meet-form />
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
