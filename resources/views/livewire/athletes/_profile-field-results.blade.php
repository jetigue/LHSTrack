<x-headings.section>Field Event Results</x-headings.section>

<div class="flex flex-col space-y-4 w-full md:w-2/3 lg:w-3/4 text-gray-300">
    <div class="">
        <div class="flex py-1 border-b-2 border-gray-500">
            <div class="w-2/12">
                Event
            </div>
            <div class="w-2/12">
                Date
            </div>
            <div class="w-4/12">
                Meet
            </div>
            <div class="w-2/12 text-center">
                Mark
            </div>
            <div class="w-1/12 text-center">
                Place
            </div>

            <div class="w-1/12 text-center">
                Points
            </div>
        </div>
        <div class="py-4">
            @foreach($fieldTrackEvents as $fieldTrackEvent)
                <div class="w-full border-b border-gray-800">
                    <div class="w-2/12 text-lg font-semibold text-gray-500">
                        {{$fieldTrackEvent->name}}
                    </div>
                </div>
                @foreach($fieldEventResults->where('track_event_id', '=', $fieldTrackEvent->id)->sortByDesc('trackMeet.meet_date') as $result)
                    <div class="flex space-y-4 items-center @if(floatval($result->total_inches + ($result->quarter_inch != null ? ($result->quarter_inch/4) : 0)) == $result->athlete->fieldEventResults->where('track_event_id', $result->track_event_id)->max('total_distance')) text-purple-400 @endif">
                        <div class=" flex w-2/12 justify-center pt-4 items-center">
                            @if (floatval($result->total_inches + ($result->quarter_inch != null ? ($result->quarter_inch/4) : 0)) == $result->athlete->fieldEventResults->where('track_event_id', $result->track_event_id)->max('total_distance'))
                                    PR
                            @endif
                        </div>
                        <div class="w-2/12">
                            {{ $result->teamResult->trackMeet->meet_date->format('M j, Y')}}
                        </div>
                        <div class="w-4/12 truncate">
                            <a href="{{ $result->teamResult->trackMeet->path() }}" class="hover:underline">
                                {{ $result->teamResult->trackMeet->meetName->name}}
                            </a>
                        </div>
                        <div class="w-2/12 text-center">
                            {{ $result->mark}}<span
                                class="text-gray-500 text-sm">{{ $result->fraction }}</span>
                            "
                            @if (floatval($result->mark + ($result->quarter_inch/4)) === $result->athlete->fieldEventResults->max('total_distance'))
                                PR
                                @endif
                        </div>
                        <div class="w-1/12 text-center text-sm">
                            {{ $result->place_with_suffix}}
                        </div>
                        <div class="w-1/12 text-center">
                            {{ $result->points}}
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>

