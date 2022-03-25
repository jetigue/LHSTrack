<x-table.table class="table-fixed relative" color="gray-100">
    <x-slot name="head">
        <x-table.header-row class="">
            <x-table.heading class="w-full">
                Event
            </x-table.heading>
        </x-table.header-row>
    </x-slot>
    <x-slot name="body">
        @forelse($trackEvents as $event)
            @include('livewire.meets.track._meet-events')
        @empty
            <x-table.row class="flex w-full">
                <div class="flex flex-col items-center mx-auto">
                    <x-icon.emoji-sad class="text-gray-500 h-10 w-10" />
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No Events</h3>
                    <div class="mt-6">
                    </div>
                </div>
            </x-table.row>
        @endforelse
    </x-slot>
</x-table.table>
