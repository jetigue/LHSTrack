<x-headings.section>Relay Event Results</x-headings.section>

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
                Time
            </div>
            <div class="w-1/12 text-center">
                Place
            </div>

            <div class="w-1/12 text-center">
                Points
            </div>
        </div>
        <div class="py-4">

            @foreach($relayTrackEvents->sortby('distance_in_meters') as $relayTrackEvent)
                <div class="w-full border-b border-gray-800">
                    <div class="w-2/12 text-lg font-semibold text-gray-500">
                        {{$relayTrackEvent->name}}
                    </div>
                </div>
                @foreach($relayEventResults->where('track_event_id', '==', $relayTrackEvent->id)->sortByDesc('teamResult.trackMeet.meet_date') as $result)
                    <div class="flex space-y-4 items-center">
                        <div class=" flex w-2/12 justify-center pt-4 items-center">

                        </div>
                        <div class="flex w-2/12">
                            {{ $result->teamResult->trackMeet->meet_date->format('M j, Y')}}
                        </div>
                        <div class="flex w-4/12 truncate">
                            <a href="{{ $result->teamResult->trackMeet->path() }}" class="hover:underline">
                                {{ $result->teamResult->trackMeet->meetName->name}}
                            </a>
                        </div>
                        <div class="flex w-2/12 justify-center items-baseline">
                            {{ $result->time}}<span
                                class="text-sm">.{{ $result->milliseconds }}</span>
                        </div>
                        <div class="flex w-1/12 justify-center text-sm">
                            {{ $result->place_with_suffix}}
                        </div>
                        <div class="flex w-1/12 justify-center">
                            {{ $result->points / 4}}
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
