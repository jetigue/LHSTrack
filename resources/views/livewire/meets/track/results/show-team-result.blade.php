<div class="w-full">
    <div class="py-2">
        <x-breadcrumb.menu>
            <x-breadcrumb.item href="{{ route('Track Meets') }}" :leadingArrow=" false ">
                Track Meets
            </x-breadcrumb.item>
            <x-breadcrumb.item href="{{ $teamResult->trackMeet->path() }}" :leadingArrow=" true ">
                {{ $teamResult->trackMeet->meetName->name }}
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

    <div class="grid grid-cols-4 gap-6 lg:gap-10 items-start">
        <div class="grid col-span-4 md:col-span-3">
            <livewire:meets.track.results.team-result-events-form :teamResult="$teamResult" />
            <livewire:meets.track.track-meet-events-index :teamResult="$teamResult" />
        </div>
        <div class="hidden md:grid md:col-span-1 pt-8">
            <x-headings.section>
                Other Results
            </x-headings.section>

            <ul class="text-gray-100 space-y-2">
                @foreach($otherTeamResults as $otherTeamResult)
                    <li>
                        <a href="{{ $otherTeamResult->path() }}" class="hover:font-semibold hover:underline">
                            {{ $otherTeamResult->division->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>


</div>
