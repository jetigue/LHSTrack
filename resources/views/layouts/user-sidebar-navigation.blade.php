<!-- This example requires Tailwind CSS v2.0+ -->
<div
    class="hidden lg:flex lg:flex-col lg:w-64 bg-black overflow-y-auto min-h-full">

    <div class="flex-grow flex flex-col">
        <nav class="flex-1 px-2 space-y-1" aria-label="Sidebar">
            <div class="flex-shrink-0">
                @if (!Route::is('home'))
                    <a href="/" class="flex h-full items-center">
                        <x-logo class="w-12 lg:w-24" />

                        <div class="hidden md:flex text-xl text-white font-bold tracking-tight -ml-4 pt-2">
                            Lambert Track
                        </div>
                    </a>
                @endif
            </div>

{{--            <x-navigation.sidebar-navigation-link route="dashboard">--}}
{{--                <svg class="text-gray-700 mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>--}}
{{--                </svg>--}}
{{--                Dashboard--}}
{{--            </x-navigation.sidebar-navigation-link>--}}

            <x-navigation.sidebar-navigation-link route="Athletes">
                <x-icon.user-group class="mr-3"/>
                Athletes
            </x-navigation.sidebar-navigation-link>

{{--            <x-navigation.sidebar-navigation-link route="users">--}}
{{--                <x-icon.user-group class="mr-3"/>--}}
{{--                Users--}}
{{--            </x-navigation.sidebar-navigation-link>--}}

{{--            <x-navigation.sidebar-navigation-link route="calendar">--}}
{{--                <x-icon.calendar class="mr-3"/>--}}
{{--                Calendar--}}
{{--            </x-navigation.sidebar-navigation-link>--}}

            <x-navigation.sidebar-navigation-menu title="Communication">
                <x-navigation.sidebar-navigation-menu-item route="Team Announcements">
                    Announcements
                </x-navigation.sidebar-navigation-menu-item>
                <x-navigation.sidebar-navigation-menu-item route="Team Events">
                    Team Events
                </x-navigation.sidebar-navigation-menu-item>
            </x-navigation.sidebar-navigation-menu>

{{--            <x-navigation.sidebar-navigation-menu title="Training">--}}
{{--                <x-navigation.sidebar-navigation-menu-item route="training dashboard">--}}
{{--                    Training Dashboard--}}
{{--                </x-navigation.sidebar-navigation-menu-item>--}}
{{--                <x-navigation.sidebar-navigation-menu-item route="macrocycles">--}}
{{--                    Training Plans--}}
{{--                </x-navigation.sidebar-navigation-menu-item>--}}

{{--            </x-navigation.sidebar-navigation-menu>--}}


        </nav>
    </div>
</div>
