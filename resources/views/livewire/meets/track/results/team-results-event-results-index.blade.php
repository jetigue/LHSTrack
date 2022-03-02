<div>
    <div class="py-2">
        <x-breadcrumb.menu>
            <x-breadcrumb.item href="{{ route('Track Meets') }}" :leadingArrow=" false ">
                Track Meets
            </x-breadcrumb.item>
            <x-breadcrumb.item href="{{ $teamResult->trackMeet->path() }}" :leadingArrow=" true ">
                {{ $teamResult->trackMeet->meetName->name }}
            </x-breadcrumb.item>
            <x-breadcrumb.item href="{{ $teamResult->path() }}" :leadingArrow=" true ">
                {{ $teamResult->division->name }}
            </x-breadcrumb.item>
        </x-breadcrumb.menu>

        <div class="flex h-full justify-between text-2xl md:text-3xl lg:text-4xl font-light text-gray-100 items-end">
            <div>
                {{ $teamResult->trackMeet->meetName->name }}
            </div>
            @if ($teamResult->trackMeet->meet_page_url)
                <a href="{{ $teamResult->trackMeet->meet_page_url }}"
                   class="hidden md:flex text-sm text-gray-500 hover:text-red-700 font-semibold">
                    Meet Page
                </a>
            @endif
        </div>
    </div>

    @include('livewire.meets.track.results._team_result_header')

    <div class="w-full grid grid-cols-4 gap-4 lg:gap-10 py-5">
        <div class="w-full col-span-4 md:col-span-3">
            @if ($trackEvent->eventSubtype->eventType->name == 'Running')
                @if ($trackEvent->eventSubtype->name == 'Relays')
                    <livewire:meets.track.results.relay-event-results-index
                        :trackEvent="$trackEvent"
                        :teamResult="$teamResult"
                    />
                @else
                    <livewire:meets.track.results.running-event-results-index
                        :trackEvent="$trackEvent"
                        :teamResult="$teamResult"
                    />
                @endif
            @elseif ($trackEvent->eventSubtype->eventType->name == 'Field')
                <livewire:meets.track.results.field-event-results-index
                    :trackEvent="$trackEvent"
                    :teamResult="$teamResult"
                />
            @endif
        </div>
        <div class="col-span-4 md:col-span-1 lg:pl-6">
            @include('livewire.meets._meet_event_menu')
        </div>
    </div>
</div>
