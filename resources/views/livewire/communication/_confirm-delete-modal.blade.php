<x-modal.confirmation wire:model.defer="showConfirmModal">
    <x-slot name="title">Delete Announcement?</x-slot>
    <x-slot name="content">Are you sure you want to delete this announcement? This cannot be
        undone.
    </x-slot>
    <x-slot name="footer">
        <x-button.tertiary wire:click="$toggle('showConfirmModal')">Cancel</x-button.tertiary>
        <x-button.danger wire:click="destroy({{ $announcement->id }})">Yes, Delete Announcement
        </x-button.danger>
    </x-slot>
</x-modal.confirmation>
