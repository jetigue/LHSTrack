<div class="py-2">
    <x-breadcrumb.menu>
        <x-breadcrumb.item href="{{ route('Track Meets') }}" :leadingArrow=" false ">
            Track Meets
        </x-breadcrumb.item>
    </x-breadcrumb.menu>

    <div class="flex h-full text-2xl md:text-3xl lg:text-4xl font-light text-gray-100 items-end">
        {{ $trackMeet->meetName->name }}
    </div>
</div>

<div class="flex flex-col w-full">
    <div class="flex flex-col">
        <div class="px-4 text-gray-100 border-t-2 border-b-2 border-red-700">
            <div class="flex flex-wrap justify-between py-1">
                <div class="flex w-full md:w-1/3 md:justify-start md:items-center">
                    {{date('F j, Y', strtotime( $trackMeet->meet_date))}}
                </div>
                <div class="flex w-full md:w-1/3 text-sm md:justify-center space-x-2">
                    <ul class="flex flex-col items-end text-gray-500">
                        <li>Venue:</li>
                        <li>Host:</li>
                    </ul>
                    <ul class="flex flex-col items-start">
                        <li>{{ $trackMeet->venue->name }}</li>
                        <li>{{ $trackMeet->host->name }}</li>
                    </ul>
                </div>
                <div class="flex w-full md:w-1/3 text-sm md:justify-end space-x-2">
                    <ul class="flex flex-col items-end text-gray-500">
                        <li>Season:</li>
                        <li>Timing:</li>
                    </ul>
                    <ul class="flex flex-col items-start">
                        <li>{{ $trackMeet->season->name }}</li>
                        <li>{{ $trackMeet->timingMethod->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="py-4">
        <livewire:meets.track-meet-events-form :trackMeet="$trackMeet" />
        <livewire:meets.track-meet-events-index :trackMeet="$trackMeet" />
    </div>



</div>
