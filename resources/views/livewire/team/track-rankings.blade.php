<div>
    <x-headings.page>
        <x-slot name="breadcrumbs">
            <x-breadcrumb.menu>
                <x-breadcrumb.item href="{{ route('Dashboard') }}" :leadingArrow="false">
                    Dashboard
                </x-breadcrumb.item>
            </x-breadcrumb.menu>
        </x-slot>
        Track Rankings
    </x-headings.page>

    <div class="grid grid-cols-6 gap-4 md:gap-6 lg:gap-8 items-start">
        <div class="grid col-span-6 md:col-span-4 order-2 md:order-1 space-y-2">
            <div class="flex text-gray-500 text-lg justify-between flex-wrap md:text-center">
                <div class="w-full md:w-1/3">Sex: <span class="text-purple-400 font-semibold">{{ $this->showingSex }}</span></div>
                <div class="w-full md:w-1/3">Grade: <span class="text-purple-400 font-semibold">{{ $this->showingGrade }}</span></div>
                <div class="w-full md:w-1/3">Event: <span class="text-purple-400 font-semibold">{{ $this->showingEvent }}</span></div>
            </div>
            <x-table.table class="table-fixed relative">
                <x-slot name="head">
                    <x-table.header-row class="flex w-full">
                        <x-table.heading class="flex w-2/12 md:w-1/12 justify-center">
                           Rank
                        </x-table.heading>
                        <x-table.heading class="flex w-4/12 lg:w-3/12 items-baseline justify-center">
                            Time
                        </x-table.heading>
                        <x-table.heading class="flex w-6/12 lg:w-4/12">
                            Athlete
                        </x-table.heading>
                        <x-table.heading class="hidden lg:flex md:w-4/12">
                            Meet
                        </x-table.heading>
                    </x-table.header-row>
                </x-slot>
{{--{{ dd($bestTimes->unique('athlete_id')) }}--}}
                <x-slot name="body">
                    @foreach($this->performance == 'perAthlete' ? $bestTimes->unique('athlete_id') : $bestTimes as $bestTime)
                        <x-table.row class="flex justify-between ">
                            <x-table.cell class="flex w-2/12 md:w-1/12 text-sm md:text-base justify-center">
                                {{ $rank++ }}
                            </x-table.cell>
                            <x-table.cell class="flex w-4/12 lg:w-3/12 items-baseline text-sm md:text-base justify-center">
{{--                                {{ ltrim($bestTime->total_seconds > 59 ? gmdate('i:s', $bestTime->total_seconds) : gmdate('s', $bestTime->total_seconds), 0) }}--}}
{{--                                <span class="text-xs">.{{ $bestTime->milliseconds }}</span>--}}
                                {{ ltrim(floor($bestTime->total_time) > 59 ? gmdate('i:s', floor($bestTime->total_time)) : gmdate('s', floor($bestTime->total_time)), 0) }}
                                <span class="text-xs">.{{ explode('.', number_format($bestTime->total_time, 2))[1]}}</span>
                            </x-table.cell>
                            <x-table.cell class="flex w-6/12 lg:w-4/12 text-sm md:text-base">
                                {{ $bestTime->athlete->last_name }}, {{ $bestTime->athlete->first_name }}
                            </x-table.cell>

                            <x-table.cell class="hidden lg:flex flex-col lg:w-4/12 text-sm truncate">
                                <div class="">{{ $bestTime->teamresult->trackMeet->meetName->name }}</div>
{{--                                <div class="pl-4 text-xs">{{ Carbon\Carbon::createFromFormat('Y-m-d', $bestTime->meetDate)->format('F j, Y') }}</div>--}}
                            </x-table.cell>
                            <x-table.cell class="absolute lg:hidden right-1 md:right-2 lg:right-4">
                                <x-dropdown.dropdown width="72">
                                    <x-slot name="trigger">
                                        <x-icon.dots-vertical class="text-gray-300 hover:text-red-700" />
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="flex flex-col p-4 space-y-2">
                                            <div>{{ $bestTime->teamresult->trackMeet->meetName->name }}</div>
{{--                                            <div>{{ Carbon\Carbon::createFromFormat('Y-m-d', $bestTime->meetDate)->format('F j, Y') }}</div>--}}
                                            <div>Grad year: {{ $bestTime->athlete->grad_year }}</div>
                                        </div>
                                    </x-slot>
                                </x-dropdown.dropdown>
                            </x-table.cell>

                        </x-table.row>

                    @endforeach
                </x-slot>
            </x-table.table>
            <div class="text-gray-300">
                {{ $bestTimes->links() }}
            </div>
        </div>
        <div class="grid col-span-6 md:col-span-2 order-1 md:order-2">
            <div class="flex justify-between items-baseline">
                <div class="text-xl text-gray-200">
                    Filters
                </div>
                <button type="button" wire:click="clearFilters" class="text-xs text-gray-300 hover:text-gray-200">
                    Reset
                </button>
            </div>

            <x-input.group for="event" label="Event">
                <x-input.select wire:model="event">
                    <option value="">All</option>
                    @foreach($runningEvents as $runningEvent)
                        <option value="{{ $runningEvent->id }}">{{$runningEvent->name}}</option>
                    @endforeach
                </x-input.select>
            </x-input.group>

            <x-input.group for="sex" label="Sex">
                <x-input.select wire:model="sex">
                    <option value="">All</option>
                    <option value="m">Boys</option>
                    <option value="f">Girls</option>
                </x-input.select>
            </x-input.group>

            <x-input.group for="grade" label="Grade">
                <x-input.select wire:model="grade">
                    <option value="">All</option>
                    <option value="{{ $this->year }}">Seniors</option>
                    <option value="{{ $this->year + 1 }}">Juniors</option>
                    <option value="{{ $this->year + 2 }}">Sophomores</option>
                    <option value="{{ $this->year + 3 }}">Freshmen</option>
                </x-input.select>
            </x-input.group>

            <x-input.group for="performance" label="Performances">
                <x-input.select wire:model="performance">
                    <option value="perAthlete">Best per Athlete</option>
                    <option value="perEvent">Best per Event</option>
                </x-input.select>
            </x-input.group>
        </div>
    </div>
</div>
