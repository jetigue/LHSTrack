<div>
    <x-headings.page>
        Dashboard
    </x-headings.page>


    <div class="grid grid-cols-4 gap-4">
        @can('admin')
            <div class="grid col-span-4 md:col-span-2 lg:col-span-1">
                <x-card.card-with-header>
                    <x-slot name="header">
                        Users
                    </x-slot>
                    <ul>
                        <li><a href="{{ route('Users') }}">Users</a></li>
                        <li><a href="{{ route('User Roles') }}">User Roles</a></li>
                    </ul>
                </x-card.card-with-header>
            </div>

            <div class="grid col-span-4 md:col-span-2 lg:col-span-1">
                <x-card.card-with-header>
                    <x-slot name="header">
                        Event Properties
                    </x-slot>
                    <ul>
                        <li><a href="/properties/genders">Genders</a></li>
                        <li><a href="/properties/levels">Levels</a></li>
                        <li><a href="/properties/division">Divisions</a></li>
                        <li><a href="/properties/race-titles">Race Titles</a></li>
                        <li><a href="/properties/timing-methods">Timing Methods</a></li>
                    </ul>
                </x-card.card-with-header>
            </div>
        @endcan

        @can('coach')
            <div class="grid col-span-4 md:col-span-2 lg:col-span-1">
                <x-card.card-with-header>
                    <x-slot name="header">
                        Athletes
                    </x-slot>
                    <ul>
                        <li><a href="{{ route('Athletes') }}">Athletes</a></li>
                        <li><a href="{{ route('Physicals') }}">Physicals</a></li>
                    </ul>
                </x-card.card-with-header>
            </div>

            <div class="grid col-span-4 md:col-span-2 lg:col-span-1">
                <x-card.card-with-header>
                    <x-slot name="header">
                        Communication
                    </x-slot>
                    <ul>
                        <li><a href="{{ route('Team Announcements') }}">Team Announcements</a></li>
                        <li><a href="{{ route('Team Events') }}">Team Events</a></li>
                    </ul>
                </x-card.card-with-header>
            </div>

            <div class="grid col-span-4 md:col-span-2 lg:col-span-1">
                <x-card.card-with-header>
                    <x-slot name="header">
                        Meets
                    </x-slot>
                    <ul>
                        <li><a href="{{ route('Track Meets') }}">Track Meets</a></li>
                    </ul>
                </x-card.card-with-header>
            </div>

            <div class="grid col-span-4 md:col-span-2 lg:col-span-1">
                <x-card.card-with-header>
                    <x-slot name="header">
                        Time Trials
                    </x-slot>
                    <ul>
                        <li><a href="{{ route('Track Time Trials') }}">Track Time Trials</a></li>
                    </ul>
                </x-card.card-with-header>
            </div>

            <div class="grid col-span-4 md:col-span-2 lg:col-span-1">
                <x-card.card-with-header>
                    <x-slot name="header">
                        Track Meet Properties
                    </x-slot>
                    <ul>
                        <li><a href="/meet-hosts">Meet Hosts</a></li>
                        <li><a href="/track/meet-names">Track Meet Names</a></li>
                        <li><a href="/track/seasons">Track Seasons</a></li>
                        <li><a href="/track/surfaces">Track Surfaces</a></li>
                        <li><a href="/track/venues">Track Venues</a></li>
                    </ul>
                </x-card.card-with-header>
            </div>

            <div class="grid col-span-4 md:col-span-2 lg:col-span-1">
                <x-card.card-with-header>
                    <x-slot name="header">
                        Track Events
                    </x-slot>
                    <ul>
                        <li><a href="/track/events">Track Events</a></li>
                        <li><a href="/track/event-types">Track Event Types</a></li>
                        <li><a href="/track/event-subtypes">Track Event SubTypes</a></li>
                    </ul>
                </x-card.card-with-header>
            </div>
            @endcan


        @auth
            <div class="grid col-span-4 md:col-span-2 lg:col-span-1">
                <x-card.card-with-header color="green-500">
                    <x-slot name="header">
                        <div class="text-white">
                            Hurdles
                        </div>

                    </x-slot>
                    <ul class="text-gray-300 space-y-2">
                        <li class="hover:underline"><a href="{{ route('Hurdles') }}">Hurdles</a></li>
                        <li class="hover:underline"><a href="{{ route('Hurdles Calendar') }}">Hurdle Calendar</a></li>

                    </ul>
                </x-card.card-with-header>
            </div>

        @endauth
    </div>
</div>
