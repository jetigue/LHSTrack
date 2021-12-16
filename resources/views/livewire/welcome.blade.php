<div class="flex flex-col w-full">
    <x-slot name="banner">
        @include('layouts.banner')
    </x-slot>

    <div class="flex w-full py-12 space-x-6">
        <div class="w-full md:w-2/3">
            <livewire:main.welcome-page-announcements />
        </div>

        <div class="w-1/3">
            <livewire:main.welcome-page-team-events />
        </div>

{{--        <div class="w-1/6">--}}
{{--            <x-card.card-with-header>--}}
{{--                <x-slot name="header">--}}
{{--                    Quick Links--}}
{{--                </x-slot>--}}
{{--                <ul class="space-y-1">--}}
{{--                    <li><a href="#">Meet Schedule</a></li>--}}
{{--                    <li><a href="#">Boys Roster</a></li>--}}
{{--                    <li><a href="#">Girls Roster</a></li>--}}
{{--                    <li><a href="#">GHSA Track Page</a></li>--}}
{{--                    <li><a href="#">GA Milesplit</a></li>--}}
{{--                </ul>--}}
{{--            </x-card.card-with-header>--}}
{{--        </div>--}}


    </div>

</div>
