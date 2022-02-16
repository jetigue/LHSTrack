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
        <x-navigation.mobile-link route="Hurdles">Hurdles Home</x-navigation.mobile-link>
        <x-navigation.mobile-link route="Hurdles Calendar">Hurdles Calendar</x-navigation.mobile-link>
        @if($hurdleLinks)
            <x-navigation.user-menu title="Hurdle Links">
                @foreach($hurdleLinks as $link)
                    <li class="flex w-full justify-between">
                        <a class="text-gray-400 font-semibold hover:text-gray-200"
                           href="{{ url($link->url) }}">
                            {{ $link->text }}
                        </a>
                    </li>
                @endforeach
            </x-navigation.user-menu>
        @endif
    </div>
</div>
