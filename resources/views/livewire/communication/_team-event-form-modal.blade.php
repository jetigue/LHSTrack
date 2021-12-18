<x-modal.dialog wire:model.defer="showFormModal">
    <x-slot name="title">
        <div x-data="{editing: @entangle('editing')}">
            <span x-show="editing === true">Edit Event</span>
            <span x-show="editing === false">Create an Event</span>
        </div>

    </x-slot>

    <x-slot name="content">
        <livewire:communication.team-event-form />
    </x-slot>

    <x-slot name="footer">
        <div x-data="{editing: @entangle('editing')}" class="flex space-x-2">
            <x-button.secondary wire:click="cancel">Cancel</x-button.secondary>
            <x-button.primary wire:click="$emit('submitCreate')">
                <span x-show="editing === true">Save</span>
                <span x-show="editing === false">Create</span>
            </x-button.primary>
        </div>
    </x-slot>
</x-modal.dialog>
