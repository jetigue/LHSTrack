<div x-cloak x-data="{ show: @entangle('addOrEditBoysEvents') }" class="flex flex-col py-4">
    <x-headings.section>
        Boys Events
        <x-slot name="action">

            <div x-show="show" class="flex space-x-4">
                <x-button.tertiary wire:click="hideBoysEventsForm">
                    Cancel
                </x-button.tertiary>

                <x-button.primary wire:click="saveBoysEventChanges">
                    Save Changes
                </x-button.primary>

            </div>

            <div x-show="!show">
                <x-button.primary wire:click="showBoysEventsForm" disabled="{{ $isDisabledBoys }}">
                    @if ( count($timeTrial->boysTrackEvents) > 0 )
                        Edit Boys Events
                    @else
                        <x-icon.plus /> Add Boys Events
                    @endif
                </x-button.primary>
            </div>

        </x-slot>
    </x-headings.section>

    <div class="flex lg:justify-between flex-wrap py-4">
        @foreach ($eventCategories as $category)
            <div class="flex w-full md:w-1/3 lg:w-1/6 my-2 md:m-0 md:p-2 lg:space-x-2">
                <x-card.card-with-header color="black" class="border border-gray-200">
                    <x-slot name="header">
                        <div class="text-red-700">
                            {{ $category->name }}
                        </div>

                    </x-slot>
                    <div>
                        <ol x-show="show" class="space-y-1.5">
                            @foreach($trackEvents->where('event_category_id', $category->id) as $trackEvent)
                                <li wire:key="{{ $loop->index }}" class="relative flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="event_id" aria-describedby="track-event"
                                               wire:model="selected"
                                               value="{{ $trackEvent->id }}"
                                               name="event_id"
                                               type="checkbox"
                                               class="focus:ring-red-800 h-4 w-4 text-red-800 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="event_id"
                                               class="font-medium text-gray-300">{{ $trackEvent->name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                        <ol x-show="!show" wire:poll.500.visible class="space-y-1.5">
                            @foreach($timeTrial->boysTrackEvents->where('event_category_id', $category->id) as $event)
                                <li class="flex items-start">
                                    <div class="text-sm font-medium text-gray-200">
                                        {{ $event->name }}
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </x-card.card-with-header>
            </div>
        @endforeach
    </div>
</div>

<div x-cloak x-data="{ show: @entangle('addOrEditGirlsEvents') }" class="flex flex-col py-4">
    <x-headings.section>
        Girls Events
        <x-slot name="action">

            <div x-show="show" class="flex space-x-4">
                <x-button.tertiary wire:click="hideGirlsEventsForm">
                    Cancel
                </x-button.tertiary>

                <x-button.primary wire:click="saveGirlsEventChanges">
                    Save Changes
                </x-button.primary>

            </div>

            <div x-show="!show">
                <x-button.primary wire:click="showGirlsEventsForm" disabled="{{ $isDisabledGirls }}">
                    @if ( count($timeTrial->girlsTrackEvents) > 0 )
                        Edit Girls Events
                    @else
                        <x-icon.plus /> Add Girls Events
                    @endif
                </x-button.primary>
            </div>

        </x-slot>
    </x-headings.section>


    <div class="flex lg:justify-between flex-wrap py-4">
        @foreach ($eventCategories as $category)
            <div class="flex w-full md:w-1/3 lg:w-1/6 my-2 md:m-0 md:p-2 lg:space-x-2">
                <x-card.card-with-header color="black" class="border border-gray-200">
                    <x-slot name="header">
                        <div class="text-red-700">
                            {{ $category->name }}
                        </div>

                    </x-slot>
                    <div>
                        <ol x-show="show" class="space-y-1.5">
                            @foreach($trackEvents->where('event_category_id', $category->id) as $trackEvent)
                                <li wire:key="{{ $loop->index }}" class="relative flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="event_id" aria-describedby="track-event"
                                               wire:model="selected"
                                               value="{{ $trackEvent->id }}"
                                               name="event_id"
                                               type="checkbox"
                                               class="focus:ring-red-800 h-4 w-4 text-red-800 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="event_id"
                                               class="font-medium text-gray-300">{{ $trackEvent->name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                        <ol x-show="!show" class="space-y-1.5">
                            @foreach($timeTrial->girlsTrackEvents->where('event_category_id', $category->id) as $event)
                                <li class="flex items-start">
                                    <div class="text-sm font-medium text-gray-200">
                                        {{ $event->name }}
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </x-card.card-with-header>
            </div>
        @endforeach
    </div>
</div>
<?php
