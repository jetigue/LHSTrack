@props([
    'id' => null,
    'maxWidth' => null,
    'name' => 'Record'
    ])

<x-modal.modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg font-semibold border-b-2 border-red-800">
            <div x-data="{editing: @entangle('editing')}" class="py-1">
                <template x-if="editing === true">
                    <p>Edit {{ $name }}</p>
                </template>
                <template x-if="editing === false">
                    <p>Create a {{ $name }}</p>
                </template>
            </div>
        </div>

        <div class="mt-4">
            {{ $slot }}
        </div>
    </div>

    <div class="rounded-b-lg px-6 py-3 bg-gray-200">
        <div x-data="{ editing: @entangle('editing') }" class="flex w-full justify-end space-x-2">
            <x-button.secondary wire:click="cancel">Cancel</x-button.secondary>
            <x-button.primary wire:click="$emit('submitCreate')">
                <template x-if="editing === true">
                    <p>Save</p>
                </template>
                <template x-if="editing === false">
                    <p>Create</p>
                </template>
            </x-button.primary>
        </div>
    </div>
</x-modal.modal>
