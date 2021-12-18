<x-modal.confirmation wire:model.defer="showConfirmModal">
    <x-slot name="title">Delete Event?</x-slot>
    <x-slot name="content">Are you sure you want to delete this event This cannot be
        undone.
    </x-slot>
    <x-slot name="footer">
        <x-button.secondary wire:click="$toggle('showConfirmModal')">Cancel</x-button.secondary>
        <x-button.danger wire:click="destroy({{ $event->id }})">Yes, Delete Event
        </x-button.danger>
    </x-slot>
</x-modal.confirmation>
