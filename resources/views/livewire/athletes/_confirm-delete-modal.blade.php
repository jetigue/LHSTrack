<x-modal.confirmation wire:model.defer="showConfirmModal">
    <x-slot name="title">Delete Athlete?</x-slot>
    <x-slot name="content">Are you sure you want to delete this athlete? This cannot be
        undone.
    </x-slot>
    <x-slot name="footer">
        <x-button.tertiary wire:click="$toggle('showConfirmModal')">
            Cancel
        </x-button.tertiary>
        <x-button.danger wire:click="destroy({{ $athlete->id }})" class="w-full">
            Yes, Delete Athlete
        </x-button.danger>
    </x-slot>
</x-modal.confirmation>
