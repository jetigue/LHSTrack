<nav x-data="{ open: false }" x-cloak class="bg-black h-20">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <div class="flex items-center">
                @if (!Route::is('home'))
                    <a href="/" class="flex h-full items-center">
                        <x-logo class="w-24" />

                        <div class="text-xl text-white font-bold tracking-tight -ml-4 pt-2">
                            Lambert Track
                        </div>
                    </a>
                @endif
            </div>
            <div class="flex w-1/2 pt-2">
                <x-nav-link href="#">Our Team</x-nav-link>
            </div>
            <div class="flex pt-2">
                @auth
                    <div class="ml-4 flex items-center md:ml-6">

                        <!-- Profile dropdown -->
                        <div class="ml-3 relative">
                            <div>
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
{{--                                        <div class="px-2">--}}
{{--                                            <hr>--}}
{{--                                        </div>--}}
{{--                                        <x-dropdown.link>--}}
{{--                                            Edit--}}
{{--                                        </x-dropdown.link>--}}
{{--                                        <x-dropdown.link>--}}
{{--                                            Delete--}}
{{--                                        </x-dropdown.link>--}}
                                    </x-slot>
                                </x-dropdown.dropdown>
                            </div>

                        </div>
                    </div>
                @endauth
                @guest
                    <x-nav-link href="{{ route('login') }}">Login</x-nav-link>
                @endguest
            </div>

            <div class="-mr-2 flex md:hidden">
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
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="border-b border-gray-700 md:hidden"
         id="mobile-menu"
    >
        <div class="px-2 py-3 space-y-1 sm:px-3">
            <x-navigation.mobile-link route="home">Home</x-navigation.mobile-link>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-700">
            <div class="flex items-center px-5">
                <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-gray-500">
                    <span class="font-medium leading-none text-white">TW</span>
                </span>
                <div class="ml-3">
                    <div class="text-base font-medium leading-none text-white"></div>
                </div>
            </div>
            <div class="mt-3 px-2 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-navigation.mobile-link
                        onclick="event.preventDefault();
                        this.closest('form').submit();"
                        route="logout"
                    >
                        Logout
                    </x-navigation.mobile-link>
                </form>
            </div>
        </div>
    </div>
</nav>
