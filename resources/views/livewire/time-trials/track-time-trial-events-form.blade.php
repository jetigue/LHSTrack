<div>
    <ol class="grid grid-cols-6 gap-4">
        @foreach($eventCategories as $eventCategory)
            <div class="grid col-span-3 md:col-span-2 lg:col-span-1">
                <x-card.card-with-header>
                    <x-slot name="header">
                        {{ $eventCategory->name }}
                    </x-slot>
                    <ol class="space-y-1.5">
                        @foreach( $eventCategory->trackEvents as $event)
                            <div class="relative flex items-start">
                              <div class="flex items-center h-5">
                                <input id="" aria-describedby="candidates-description" name="" type="checkbox" class="focus:ring-red-800 h-4 w-4 text-red-800 border-gray-300 rounded">
                              </div>
                              <div class="ml-3 text-sm">
                                <label for="candidates" class="font-medium text-gray-700">{{ $event->name }}</label>
                              </div>
                            </div>
                        @endforeach
                    </ol>
                </x-card.card-with-header>
            </div>


        @endforeach
    </ol>

</div>
