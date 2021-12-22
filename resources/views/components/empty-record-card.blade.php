@props(['model'])
<div class="flex bg-white rounded-md p-4 w-full">
    <div class="flex flex-col w-full text-center">
        <div class="flex w-full text-gray-400 justify-center">
            {{ $icon }}
        </div>
        <h3 class="mt-2 text-sm font-medium text-gray-900">No {{ $model }}s Found</h3>
        <p class="mt-1 text-sm text-gray-500">
            Get started by creating a new {{ $model }}.
        </p>

        <div class="flex w-full justify-center mt-6">
            <x-button.primary wire:click="showFormModal">
                <x-icon.plus class="mr-2"/> New {{ $model }}
            </x-button.primary>
        </div>

    </div>
</div>
