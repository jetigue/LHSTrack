<nav x-cloak x-data="{ open: false }" class="w-full bg-black">
    <div class="w-full px-2 md:px-4">
        <div class="flex items-center justify-between">
            <div class="flex h-20 items-center justify-between w-full">
                <div class="flex">
                    @if (!Route::is('home'))
                        <a href="/" class="flex h-full w-64 items-center pr-4">
                            <x-logo class="w-12 lg:w-24" />

                            <div class="text-xl text-gray-100 font-semibold -ml-4 pt-2">
                                <div class="flex">
                                    Lambert Track
                                </div>
                            </div>
                        </a>
                    @else
                        <div class="pl-0 lg:pl-32">
                            <a href="/" class="flex md:hidden">
                                <x-logo class="w-12" />
                            </a>
                        </div>

                    @endif
                </div>

                <div class="hidden lg:flex w-full h-full items-center justify-between pt-3">
                    <div class="flex w-full md:space-x-4 lg:space-x-6">
                        @auth
                        <x-nav-link route="Dashboard">Dashboard</x-nav-link>
                        @endauth
                        <x-nav-link route="Boys Roster">Boys Roster</x-nav-link>
                        <x-nav-link route="Girls Roster">Girls Roster</x-nav-link>
                        <x-nav-link route="Booster Club">Booster Club</x-nav-link>
                        <x-nav-link route="Calendar">Calendar</x-nav-link>
                    </div>
                    @guest
                        <div class="hidden lg:flex flex-shrink-0 pt-3 justify-end">
                            <x-nav-link route="login">Sign In</x-nav-link>
                        </div>
                    @endguest
                </div>
            </div>
            <div class="hidden lg:ml-6 lg:block">
                <div class="flex items-center">

                    <!-- Profile dropdown -->
                    @auth
                        <div class="ml-3 relative pt-3">
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
            <div class="flex lg:hidden">
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
            @auth
            <x-navigation.mobile-link route="Dashboard">Dashboard</x-navigation.mobile-link>
            @endauth
            <x-navigation.mobile-link route="Boys Roster">Boys Roster</x-navigation.mobile-link>
            <x-navigation.mobile-link route="Girls Roster">Girls Roster</x-navigation.mobile-link>
            <x-navigation.mobile-link route="Booster Club">Booster Club</x-navigation.mobile-link>
            <x-navigation.mobile-link route="Calendar">Calendar</x-navigation.mobile-link>
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

