<div class="grid grid-cols-2 gap-6 lg:gap-10">
    <div class="grid col-span-2 md:col-span-1">
        <x-table.table class="table-fixed relative" color="gray-100">
            <x-slot name="head">
                <x-table.header-row class="">
                    <x-table.heading class="w-full">
                        Boys Events
                    </x-table.heading>
                </x-table.header-row>
            </x-slot>
            <x-slot name="body">
                @forelse($boysEvents as $event)
                    <x-table.row
                        wire:key="{{ $loop->index }}"
                        x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                        wire:loading.class.delay="opacity-50"
                    >
                        <x-table.cell class="w-full pr-2">
                            <div class="flex justify-between">
                                <div>{{ $event->name }}</div>
                                <a href="{{ $this->trackMeet->path() }}/boys/events/{{ $event->slug }}">Results</a>
                            </div>

                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row class="flex w-full">
                        <div class="flex flex-col items-center mx-auto">
                            <x-icon.emoji-sad class="text-gray-500 h-10 w-10" />
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No Boys' Events</h3>
                            <div class="mt-6">
                            </div>
                        </div>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table.table>
    </div>
    <div class="grid col-span-2 md:col-span-1">
        <x-table.table class="table-fixed relative" color="gray-100">
            <x-slot name="head">
                <x-table.header-row class="">
                    <x-table.heading class="w-full">
                        Girls Events
                    </x-table.heading>
                </x-table.header-row>
            </x-slot>
            <x-slot name="body">
                @forelse($girlsEvents as $event)
                    <x-table.row
                        wire:key="{{ $loop->index }}"
                        x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                        wire:loading.class.delay="opacity-50"
                    >
                        <x-table.cell class="w-full pr-2">
                            <div class="flex justify-between">
                                <div>{{ $event->name }}</div>
                                <a href="{{ $this->trackMeet->path() }}/girls/events/{{ $event->slug }}">
                                    @if ($event->has('runningEventResults')->where('track_meet_id', $this->trackMeet->id)->where('gender_id', $event->gender_id)->where('track_event_id', $event->id))
                                        Results
                                    @else
                                        @can('coach')
                                            Add Results
                                        @endcan
                                    @endif
                                </a>
                            </div>

                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row class="flex w-full">
                        <div class="flex flex-col items-center mx-auto">
                            <x-icon.emoji-sad class="text-gray-500 h-10 w-10" />
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No Girls' Events</h3>
                            <div class="mt-6">
                            </div>
                        </div>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table.table>
    </div>
</div>
