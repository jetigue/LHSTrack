@props(['missingRecord'])

<div class="flex flex-col items-center mx-auto mt-4">
    <x-icon.emoji-sad class="h-10 w-10 text-gray-400" />
    <h3 class="mt-2 font-medium text-gray-700 text-lg">No {{ $missingRecord }}s Found</h3>
    <div class="mt-6">
        @can('coach')
            <x-button.add>
                Add {{ $missingRecord }}
            </x-button.add>
        @endcan
    </div>
</div>
