<div>
    <x-headings.page>
        <x-slot name="breadcrumbs">
            <x-breadcrumb.menu>
                <x-breadcrumb.item href="{{ route('Track Time Trials') }}" :leadingArrow=" false ">
                    Time Trials
                </x-breadcrumb.item>
            </x-breadcrumb.menu>
        </x-slot>
        {{ $timeTrial->name }}
    </x-headings.page>

    <div class="flex flex-col w-full">
        <div class="flex flex-col md:mt-4 md:m-0">
            <div class="px-4 py-2 border-b border-t border-gray-400 text-gray-200">
                <div class="flex flex-wrap justify-between py-1">
                    <div class="flex w-full md:w-1/3 text-sm md:text-lg md:justify-start">
                        {{date('F j, Y', strtotime( $timeTrial->trial_date))}}
                    </div>
                    <div class="flex w-full md:w-1/3 text-sm md:text-lg md:justify-center">
                        {{ $timeTrial->venue->name }}
                    </div>
                    <div class="flex w-full md:w-1/3 text-sm md:text-lg md:justify-end">
                        {{ $timeTrial->timingMethod->name }} Timing
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-cloak x-data="{ show: @entangle('addOrEditEvents') }" class="flex flex-col py-4 lg:py-8">
        <x-headings.section>
            Events
            <x-slot name="action">

                <div x-show="show" class="flex space-x-4">
                    <x-button.tertiary wire:click="hideEventsForm">
                        Cancel
                    </x-button.tertiary>

                    <x-button.primary wire:click="saveChanges">
                        Save Changes
                    </x-button.primary>

                </div>

                <div x-show="!show">
                    <x-button.primary wire:click="showEventsForm">
                        @if ( count($timeTrial->trackEvents) > 0 )
                            Edit Events
                        @else
                            <x-icon.plus /> Add Events
                        @endif
                    </x-button.primary>
                </div>

            </x-slot>
        </x-headings.section>
        <div class="flex lg:justify-between flex-wrap py-4 lg:py-8">
            @foreach ($eventCategories as $category)
                <div class="flex w-full md:w-1/3 lg:w-1/6 my-2 md:m-0 md:p-2 lg:p-0">
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
                                    @foreach($timeTrial->trackEvents->where('event_category_id', $category->id) as $event)
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
</div>
