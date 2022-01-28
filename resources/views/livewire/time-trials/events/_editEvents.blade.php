<div class="flex flex-col py-4">
    <x-headings.section>
        Boys Events
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
                        <ol class="space-y-1.5">
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
                    </div>
                </x-card.card-with-header>
            </div>
        @endforeach
    </div>
</div>

<div class="flex flex-col py-4">
    <x-headings.section>
        Girls Events
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
                        <ol class="space-y-1.5">
                            @foreach($trackEvents->where('event_category_id', $category->id) as $trackEvent)
                                <li wire:key="{{ $loop->index }}" class="relative flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="event_id" aria-describedby="track-event"
                                               wire:model="selectedGirlsEvents"
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
                    </div>
                </x-card.card-with-header>
            </div>
        @endforeach
    </div>
</div>
