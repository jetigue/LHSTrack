<x-headings.page>
    {{ $this->startsAt->format('F Y') }}
    <x-slot name="action">
        <div class="flex items-baseline text-gray-200 space-x-1 bg-gray-800 rounded-md">
            <x-button wire:click="goToPreviousMonth" class="rounded-r-none">
                <x-icon.chevron-left class="w-5 h-5" />
            </x-button>

            <x-button wire:click="goToNextMonth" class="rounded-l-none">
                <x-icon.chevron-right class="w-5 h-5" />
            </x-button>
        </div>
    </x-slot>
</x-headings.page>
