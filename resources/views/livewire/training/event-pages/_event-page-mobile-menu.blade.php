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
        @if(count($links) > 0)
            <div class="flex md:hidden">
                <x-navigation.user-menu title="{{ $eventSubtype->name }} Links">
                    @foreach($links as $link)
                        <li class="flex w-full justify-between">
                            <a class="text-gray-300 font-semibold hover:text-gray-200 py-1.5 pl-4"
                               href="{{ url($link->url) }}">
                                {{ $link->text }}
                            </a>
                        </li>
                    @endforeach
                </x-navigation.user-menu>
            </div>
        @endif
        <x-navigation.user-menu title="Event Pages">
            @foreach ($eventSubtypes as $event)
                <x-navigation.mobile-link route="{{ $event->name }}">{{ $event->name }} Home</x-navigation.mobile-link>
            @endforeach
        </x-navigation.user-menu>
        <x-navigation.user-menu title="Calendars">
            @foreach ($eventSubtypes as $event)
                <x-navigation.mobile-link route="{{ $event->name }} Calendar">{{ $event->name }} Calendar</x-navigation.mobile-link>
            @endforeach
        </x-navigation.user-menu>
    </div>
</div>
