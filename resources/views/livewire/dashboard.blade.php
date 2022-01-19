<div>
    <x-headings.page>
        Dashboard
    </x-headings.page>

    @can('coach')
    <div class="grid grid-cols-4 gap-4">
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
                    Meet Properties
                </x-slot>
                <ul>
                    <li><a href="/meet-hosts">Meet Hosts</a></li>
                    <li><a href="/timing-methods">Timing Methods</a></li>
                    <li><a href="/track/meet-names">Track Meet Names</a></li>
                    <li><a href="/track/seasons">Track Seasons</a></li>
                    <li><a href="/track/surfaces">Track Surfaces</a></li>
                    <li><a href="/track/venues">Track Venues</a></li>
                    <li><a href="/track/event-categories">Track Event Categories</a></li>
                    <li><a href="/track/events">Track Events</a></li>
                </ul>
            </x-card.card-with-header>
    </div>
    </div>
    @else
        <div class="text-xl text-center mx-auto text-yellow-200">
            Check back soon for more options
        </div>
        @endcan

</div>
