<nav x-data="{ open: false }" class="bg-black py-2">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center justify-between w-full">
{{--                <div class="flex-shrink-0">--}}
{{--                    @if (!Route::is('home'))--}}
{{--                        <a href="/" class="flex h-full items-center">--}}
{{--                            <x-logo class="w-12 lg:w-24" />--}}

{{--                            <div class="hidden md:flex text-xl text-white font-bold tracking-tight -ml-4 pt-2">--}}
{{--                                Lambert Track--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    @endif--}}
{{--                </div>--}}
                <div class="hidden lg:block sm:ml-6 lg:ml-12 pt-3 w-full">
                    <div class="flex w-full justify-center space-x-6">
                        <x-nav-link route="Boys Roster">Boys Roster</x-nav-link>
                        <x-nav-link route="Girls Roster">Girls Roster</x-nav-link>
                        <x-nav-link route="Booster Club">Booster Club</x-nav-link>
                        @can('coach')
                            <x-nav-link route="Team Announcements">Announcements</x-nav-link>
                        @endif

                    </div>
                </div>
                <div class="hidden md:flex justify-end pt-3">
                    @guest
                        @can('coach')
                            <x-nav-link route="login">Sign In</x-nav-link>
                        @endcan
                    @endguest
                </div>
            </div>
            <div class="hidden lg:ml-6 lg:block">
                <div class="flex items-center">

                    <!-- Profile dropdown -->
                    @auth
                        <div class="ml-3 relative">
                            <x-dropdown.dropdown>
                                <x-slot name="trigger"
                                        class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>

                                    <x-avatar />

                                </x-slot>
                                <x-slot name="content">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}"
                                                         onclick="event.preventDefault();
                                      this.closest('form').submit();">
                                            Logout
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown.dropdown>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="-mr-2 flex lg:hidden">
                <!-- Mobile menu button -->
                <button @click="open = !open"
                        type="button"
                        class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <x-icon.menu x-bind:class="open ? 'hidden' : 'block'" />
                    <x-icon.x x-bind:class="open ? 'block' : 'hidden'" />
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="open"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="-translate-y-full"
         class="border-b border-gray-700 lg:hidden bg-black mb-4"
         id="mobile-menu"
    >

        <div class="px-2 pt-2 pb-3 space-y-1">
            <x-navigation.mobile-link route="home">Home</x-navigation.mobile-link>
            <x-navigation.mobile-link route="Boys Roster">Boys Roster</x-navigation.mobile-link>
            <x-navigation.mobile-link route="Girls Roster">Girls Roster</x-navigation.mobile-link>
            <x-navigation.mobile-link route="Booster Club">Booster Club</x-navigation.mobile-link>
            @can('coach')
                <x-navigation.mobile-link route="Team Announcements">Announcements</x-navigation.mobile-link>
             @endcan
        </div>
        <div class="pt-4 pb-3 border-t border-gray-700">
            <div class="px-2">
                @guest
                    <x-navigation.mobile-link route="login">Sign In</x-navigation.mobile-link>
                @endguest
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-navigation.mobile-link route="logout"
                                                  onclick="event.preventDefault();
                                                  this.closest('form').submit();"
                        >
                            Logout
                        </x-navigation.mobile-link>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>

