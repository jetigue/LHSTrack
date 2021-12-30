<div class="grid grid-cols-6 gap-6">
    <div class="col-span-6 lg:col-span-5">
        <div class="flex flex-col w-full">
            <div class="lg:py-4 flex justify-between items-center">
                <button
                    type="button"
                    wire:click="goToPreviousMonth"
                    class="flex items-center text-gray-400 hover:text-gray-700 focus:text-blue-600"
                >
                    <x-icon.arrow-left class="pr-2"/>
                </button>
                <div class="text-2xl md:text-3xl lg:text-5xl font-thin text-gray-300 text-center">
                    {{ $this->selectedMonth->format('F Y') }}
                </div>
                <button
                    type="button"
                    wire:click="goToNextMonth"
                    class="flex items-center text-gray-400 hover:text-gray-700 focus:text-blue-600"
                    >
                    <x-icon.arrow-right class="pl-2"/>
                </button>
            </div>
            <div class="flex w-full text-center text-xs md:text-sm text-gray-500 pb-1">
                <div class="w-1/7">
                    <span class="md:hidden">Sun</span>
                    <span class="hidden md:inline-block">Sunday</span>
                </div>
                <div class="w-1/7">
                    <span class="md:hidden">Mon</span>
                    <span class="hidden md:inline-block">Monday</span>
                </div>
                <div class="w-1/7">
                    <span class="md:hidden">Tue</span>
                    <span class="hidden md:inline-block">Tuesday</span>
                </div>
                <div class="w-1/7">
                    <span class="md:hidden">Wed</span>
                    <span class="hidden md:inline-block">Wednesday</span>
                </div>
                <div class="w-1/7">
                    <span class="md:hidden">Thu</span>
                    <span class="hidden md:inline-block">Thursday</span>
                </div>
                <div class="w-1/7">
                    <span class="md:hidden">Fri</span>
                    <span class="hidden md:inline-block">Friday</span>
                </div>
                <div class="w-1/7">
                    <span class="md:hidden">Sat</span>
                    <span class="hidden md:inline-block">Saturday</span>
                </div>
            </div>
            <div class="grid grid-cols-7 w-full divide-y-2 divide-x-2 divide-gray-100">
                @switch($dates->first()->day_name)
                    @case('Monday')
                    <div class="col-span-1"></div>
                    @break

                    @case('Tuesday')
                    <div class="col-span-2"></div>
                    @break

                    @case('Wednesday')
                    <div class="col-span-3"></div>
                    @break

                    @case('Thursday')
                    <div class="col-span-4"></div>
                    @break

                    @case('Friday')
                    <div class="col-span-5"></div>
                    @break

                    @case('Saturday')
                    <div class="col-span-6"></div>
                    @break

                    @case('Sunday')
                    <div></div>
                    @break
                @endswitch

                @foreach ($dates as $date)
                    <div class="col-span-1 h-16 md:h-24 lg:h-32 text-tiny md:text-xs text-gray-400 p-1 . {{\Carbon\Carbon::now()->format('Y-m-d') === $date->calendar_date->format('Y-m-d') ? 'bg-gray-100' : 'bg-gray-200'}}">
                        <div class="flex flex-col">
                            <div>
                                {{ $date->day }}
                            </div>
                            <div class="p-2">
                                @if($date->teamEvents)
                                    @foreach($date->teamEvents as $event)
                                        <div class="border-l-4 border-red-800 bg-red-100 text-red-800 px-1 truncate">{{ $event->title }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-1 pt-28">
        Team Events
    </div>

</div>
