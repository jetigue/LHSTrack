<div class="flex flex-col w-full">
    <div class="flex flex-col">
        <div class="px-4 text-gray-100 border-t-2 border-b-2 border-red-700">
            <div class="flex flex-wrap justify-between py-1">
                <div class="flex w-full md:w-1/3 md:justify-start md:items-center">
                    {{date('F j, Y', strtotime( $teamResult->trackMeet->meet_date))}}
                </div>
                <div class="flex w-full md:w-1/3 text-sm md:justify-center space-x-2">
                    <ul class="flex flex-col items-end text-gray-500">
                        <li>Venue:</li>
                        <li>Host:</li>
                    </ul>
                    <ul class="flex flex-col items-start">
                        <li>{{ $teamResult->trackMeet->venue->name }}</li>
                        <li>{{ $teamResult->trackMeet->host->name }}</li>
                    </ul>
                </div>
                <div class="flex w-full md:w-1/3 text-sm md:justify-end space-x-2">
                    <ul class="flex flex-col items-end text-gray-500">
                        <li>Season:</li>
                        <li>Timing:</li>
                    </ul>
                    <ul class="flex flex-col items-start">
                        <li>{{ $teamResult->trackMeet->season->name }}</li>
                        <li>{{ $teamResult->trackMeet->timingMethod->name }}</li>
                    </ul>
                </div>
                <div class="md:hidden text-gray-300 hover:text-red-700 py-1">
                    <a href="{{ $teamResult->trackMeet->meet_page_url }}"
                    >
                        Meet Page
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col pt-8 w-full ">

    <div class="flex w-full flex-wrap bg-gray-100 p-4 rounded-lg">
        <div class="flex text-lg font-bold text-red-800 w-full md:w-1/3">
            {{ $teamResult->division->name }} Team Results
        </div>

        <div
            class="flex w-full md:w-1/3 md:justify-center text-gray-900 text-base font-semibold">
            {{ $teamResult->place_with_suffix }} Place
            <span class="text-gray-500 pl-2">
                    ({{ $teamResult->number_teams }} Teams)
            </span>
        </div>

        <div
            class="flex w-full md:w-1/3 md:justify-end text-gray-900 text-base font-semibold">
            {{ $teamResult->points }} Points
        </div>
    </div>
</div>
