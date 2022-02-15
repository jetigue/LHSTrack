<div class="w-full flex-col">
    <x-headings.section>
        Events
    </x-headings.section>
    <ol class="space-y-2 -mt-2 w-full px-4 mx:px-0">
        @foreach($boysEvents->sortBy('distance_in_meters') as $boysEvent)
            <li>
                <a href="{{ $this->trackMeet->path() }}/boys/events/{{ $boysEvent->slug }}"
                   class="text-gray-500 hover:text-gray-300"
                >
                    Boys {{$boysEvent->name}}
                </a>
            </li>
        @endforeach
        @foreach($girlsEvents->sortBy('distance_in_meters') as $girlsEvent)
            <li>
                <a href="{{ $this->trackMeet->path() }}/girls/events/{{ $girlsEvent->slug }}"
                   class="text-gray-500 hover:text-gray-300"
                >
                    Girls {{$girlsEvent->name}}
                </a>
            </li>
        @endforeach
    </ol>
</div>
