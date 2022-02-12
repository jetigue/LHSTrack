<div>

    <div class="flex flex-col">
        <x-flash />
        <div x-cloak x-data="{ show: @entangle('showEventsMenu') }" class="">
            <x-headings.section>
                <div x-show="!show" class="text-gray-400 text-2xl font-bold">
                    Events
                </div>

                @can('coach')
                    <x-slot name="action">
                        <div x-show="show" class="flex items-baseline space-x-4 mt-6">
                            <x-button.tertiary wire:click="hideMenu">
                                Cancel
                            </x-button.tertiary>

                            <x-button.primary wire:click="saveChanges">
                                Save Changes
                            </x-button.primary>
                        </div>

                        <div x-show="!show" class="flex mt-6">
                            <x-button.primary wire:click="showMenu">
                                @if ( count($trackMeet->boysTrackEvents) > 0 or  count($trackMeet->girlsTrackEvents) > 0)
                                    Edit Events
                                @else
                                    <x-icon.plus /> Add Events
                                @endif
                            </x-button.primary>
                        </div>
                    </x-slot>
                @endcan

            </x-headings.section>
            <div x-show="show"
                 x-transition:enter="transition duration-200 transform ease-out"
                 x-transition:enter-start="scale-75"
                 x-transition:leave="transition duration-100 transform ease-in"
                 x-transition:leave-end="opacity-0 scale-90"
                 class="py-4 grid grid-cols-2 gap-4"
            >
                <div class="grid col-span-2 md:col-span-1 py-4 bg-blue-200 rounded-lg space-y-4">
                    @foreach ($eventTypes as $eventType)
                        <div class="flex-col w-full px-6">
                            <div class="text-blue-900 text-xl font-semibold">
                                Boys {{ $eventType->name }}
                            </div>

                            <div class="flex flex-wrap w-full space-y-1.5">
                                @if($eventType->subTypes)
                                    @foreach($eventType->subTypes as $subType)
                                        <div class="w-full lg:w-1/3">
                                            <h3 class="text-red-800 font-semibold">{{ $subType->name }}</h3>
                                            <ol class="flex-col">
                                                @foreach($subType->trackEvents->where('boys_event', 1)->sortBy('distance_in_meters') as $trackEvent)
                                                    <li wire:key="{{ $loop->index }}" class="relative flex px-2">
                                                        <div class="flex items-center h-5">
                                                            <input id="boys-event" aria-describedby="track-event"
                                                                   wire:model="selectedBoysEvents"
                                                                   value="{{ $trackEvent->id }}"
                                                                   name="boys-event"
                                                                   type="checkbox"
                                                                   class="focus:ring-red-800 h-4 w-4 text-red-800 border-gray-300 rounded">
                                                        </div>
                                                        <div class="ml-3 text-sm">
                                                            <label for="boys-event"
                                                                   class="font-medium text-black">{{ $trackEvent->name }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="grid col-span-2 md:col-span-1 py-4 bg-red-200 rounded-lg space-y-4">
                    @foreach ($eventTypes as $eventType)
                        <div class="flex-col w-full px-6">
                            <div class="text-red-900 text-xl font-semibold">
                                Girls {{ $eventType->name }}
                            </div>

                            <div class="flex flex-wrap w-full space-y-1.5">
                                @if($eventType->subTypes)
                                    @foreach($eventType->subTypes as $subType)
                                        <div class="w-full lg:w-1/3">
                                            <h3 class="text-red-800 font-semibold">{{ $subType->name }}</h3>
                                            <ol class="flex-col">
                                                @foreach($subType->trackEvents->where('girls_event', 1)->sortBy('distance_in_meters') as $trackEvent)
                                                    <li wire:key="{{ $loop->index }}" class="relative flex px-2">
                                                        <div class="flex items-center h-5">
                                                            <input id="girls-event" aria-describedby="track-event"
                                                                   wire:model="selectedGirlsEvents"
                                                                   value="{{ $trackEvent->id }}"
                                                                   name="girls-event"
                                                                   type="checkbox"
                                                                   class="focus:ring-red-800 h-4 w-4 text-red-800 border-gray-300 rounded">
                                                        </div>
                                                        <div class="ml-3 text-sm">
                                                            <label for="girls-event"
                                                                   class="font-medium text-black">{{ $trackEvent->name }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
