<div>
    <x-headings.page>
        <x-slot name="breadcrumbs">
            <x-breadcrumb.menu>
                <x-breadcrumb.item href="{{ route($eventSubtype->name) }}" :leadingArrow="false">{{$eventSubtype->name}} Home</x-breadcrumb.item>
            </x-breadcrumb.menu>
        </x-slot>
        <div>
            {{ $eventSubtype->name }} Calendar
        </div>
        <x-slot name="action">
            <div class="flex text-gray-200 space-x-1 bg-gray-800 rounded-md">
                <x-button wire:click="goToPreviousMonth" class="rounded-r-none">
                    <x-icon.chevron-left class="w-5 h-5" />
                </x-button>

                <x-button wire:click="goToNextMonth" class="rounded-l-none">
                    <x-icon.chevron-right class="w-5 h-5" />
                </x-button>
            </div>
        </x-slot>
    </x-headings.page>
    <div class="w-full text-3xl text-gray-400 font-semibold text-center py-2">
        {{ $this->startsAt->format('F Y') }}
    </div>

</div>
