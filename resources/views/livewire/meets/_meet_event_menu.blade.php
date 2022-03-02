<div class="w-full flex-col">
    <x-headings.section>
        Other Results
    </x-headings.section>
    <ol class="space-y-2 -mt-2 w-full px-4 md:px-0">
        @foreach($trackEvents->sortBy('distance_in_meters')->sortBy('track_event_subtype_id') as $trackEvent)
            <li>
                <a href="{{ $this->teamResult->path() }}/event-results/{{ $trackEvent->slug }}"
                   class="text-gray-400 hover:text-gray-200"
                >
                    {{ $this->teamResult->division->name }} {{$trackEvent->name}}
                </a>
            </li>
        @endforeach
        @foreach($otherTeamResults as $otherTeamResult)
            @foreach($otherTeamResult->trackEvents->sortBy('distance_in_meters')->sortBy('track_event_subtype_id') as $trackEvent)
                <li>
                    <a href="{{ $otherTeamResult->path() }}/event-results/{{ $trackEvent->slug }}"
                       class="text-gray-400 hover:text-gray-200"
                    >
                        {{ $otherTeamResult->division->name }} {{$trackEvent->name}}
                    </a>
                </li>
            @endforeach
        @endforeach
    </ol>
</div>
