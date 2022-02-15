<div class="w-full flex-col">
    <x-headings.section>
        Events
    </x-headings.section>
    <ol class="space-y-2 -mt-2 w-full px-4 md:px-0">
        @foreach($boysEvents->sortBy('distance_in_meters')->sortBy('track_event_subtype_id') as $boysEvent)
            <li>
                <a href="{{ $this->trackMeet->path() }}/boys/events/{{ $boysEvent->slug }}"
                   class="text-gray-400 hover:text-gray-200"
                >
                    Boys {{$boysEvent->name}}
                </a>
            </li>
        @endforeach
        @foreach($girlsEvents->sortBy('distance_in_meters')->sortBy('track_event_subtype_id') as $girlsEvent)
            <li>
                <a href="{{ $this->trackMeet->path() }}/girls/events/{{ $girlsEvent->slug }}"
                   class="text-gray-400 hover:text-gray-200"
                >
                    Girls {{$girlsEvent->name}}
                </a>
            </li>
        @endforeach
    </ol>
</div>
