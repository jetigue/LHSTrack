<x-card.card-with-header>
    <x-slot name="header">
        Upcoming Events
    </x-slot>
        <div class="flex flex-col w-full">
                <section id="upcoming-events">
                <div class="flow-root h-56 md:h-72 lg:h-80 overflow-y-auto -mr-4">
                    <ul class="-my-5 divide-y divide-gray-200">
                        @foreach($events as $event)
                            <li class="py-4">
                                <div class="flex flex-col w-full">
                                    <div class="flex text-sm text-gray-400 font-semibold justify-center w-full">
                                        {{ $event->event_date->format('F j') }}
                                    </div>
                                    <div class="text-sm font-bold text-red-800 py-1">
                                        {{ $event->title }}
                                    </div>
                                    <div class="text-gray-700 text-sm text-left no-tailwindcss-base">
                                        {!! $event->description !!}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-8">
                    <a href="{{ route('Calendar') }}"
                       class="md:hidden w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        View All
                    </a>
                    <a href="{{ route('Calendar') }}"
                       class="hidden w-full md:flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        View Calendar
                    </a>
                </div>
                </section>
            </div>
</x-card.card-with-header>
