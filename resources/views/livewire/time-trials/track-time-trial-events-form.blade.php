<div>
    <ol class="grid grid-cols-6 gap-4">
        @foreach($eventCategories as $eventCategory)
            <div class="grid col-span-3 md:col-span-2 lg:col-span-1">
                <x-card.card-with-header>
                    <x-slot name="header">
                        <div class="relative flex items-start">
                          <div class="min-w-0 flex-1 text-sm">
                            <label
                                for="eventCategory"
                                class="font-medium text-gray-700 select-none"
                            >{{ $eventCategory->name }}
                            </label>
                          </div>
                          <div class="ml-3 flex items-center h-5">
                            <input
                                wire:model="selectGroup.{{ $eventCategory->id }}"
                                value="{{ $eventCategory->id }}"
                                id="eventCategory"
                                name="eventCategory"
                                type="checkbox"
                                class="focus:ring-red-800 h-4 w-4 text-red-800 border-gray-300 rounded">
                          </div>
                        </div>
                    </x-slot>
                    <ol class="space-y-1.5">
                        @foreach( $eventCategory->trackEvents as $event)
                            <div class="relative flex items-start">
                              <div class="flex items-center h-5">
                                <input id="event_id" aria-describedby="track-event" wire:model.lazy="selected" value="{{ $event->id }}" name="event_id" type="checkbox" selected class="focus:ring-red-800 h-4 w-4 text-red-800 border-gray-300 rounded">
                              </div>
                              <div class="ml-3 text-sm">
                                <label for="event_id" class="font-medium text-gray-700">{{ $event->name }}</label>
                              </div>
                            </div>
                        @endforeach
{{--                        Events: {{ var_export($selected) }}--}}
                    </ol>
                </x-card.card-with-header>
            </div>


        @endforeach
    </ol>
<x-button.primary wire:click="save">
    Save
</x-button.primary>
</div>
