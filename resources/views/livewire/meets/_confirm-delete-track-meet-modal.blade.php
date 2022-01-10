<x-modal.confirmation wire:model.defer="showConfirmModal">
    <x-slot name="title">Delete Track Meet?</x-slot>
    <x-slot name="content">Are you sure you want to delete this track meet? This cannot be
        undone.
    </x-slot>
    <x-slot name="footer">
        <x-button.tertiary wire:click="$toggle('showConfirmModal')">
            Cancel
        </x-button.tertiary>
        <x-button.danger wire:click="destroy({{ $trackMeet->id }})">
            Yes, Delete Track Meet
        </x-button.danger>
    </x-slot>
</x-modal.confirmation>
