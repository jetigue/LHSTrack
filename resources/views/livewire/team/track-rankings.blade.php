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
                <div class="w-full md:w-1/3">Sex: <span
                        class="text-purple-400 font-semibold">{{ $this->showingSex }}</span></div>
                <div class="w-full md:w-1/3">Grade: <span
                        class="text-purple-400 font-semibold">{{ $this->showingGrade }}</span></div>
                <div class="w-full md:w-1/3">Event: <span
                        class="text-purple-400 font-semibold">{{ $this->showingEvent }}</span></div>
            </div>

            <x-table.table class="table-fixed relative">
                <x-slot name="head">
                    <x-table.header-row class="flex w-full">
                        <x-table.heading class="flex w-2/12 md:w-1/12 justify-center">
                            Rank
                        </x-table.heading>
                        <x-table.heading class="flex w-4/12 lg:w-2/12 items-baseline justify-center">
                            {{ $this->showRunningEvent ? 'Time' : 'Mark' }}
                        </x-table.heading>
                        <x-table.heading class="flex w-6/12 lg:w-3/12">
                            Athlete
                        </x-table.heading>
                        <x-table.heading class="hidden lg:flex lg:w-2/12">
                            Grade
                        </x-table.heading>
                        <x-table.heading class="hidden lg:flex md:w-4/12">
                            Meet
                        </x-table.heading>
                    </x-table.header-row>
                </x-slot>

                <x-slot name="body">
                    @if ($this->event == '')
                        <x-table.row>
                            <div class="flex flex-col items-center mx-auto mt-4 w-full md:w-1/2">
                                <x-icon.filter class="h-10 w-10 text-gray-400" />
                                <h3 class="mt-2 text-sm font-medium text-gray-700 text-lg">Choose an Event</h3>
                                <div class="p-6 w-full">
                                    @include('livewire.team._event-selection')
                                </div>
                            </div>
                        </x-table.row>
                    @else
                        
                        @if ($this->showRunningEvent == true)
                            @foreach($this->performance == 'perAthlete' ? $bestTimes->unique('athlete_id') : $bestTimes as $bestTime)
                                @include('livewire.team._rankings-table-body')
                            @endforeach
                        @elseif ($this->showFieldEvent == true)
                            @foreach($this->performance == 'perAthlete' ? $bestMarks->unique('athlete_id') : $bestMarks as $bestTime)
                                @include('livewire.team._rankings-table-body')
                            @endforeach
                        @endif
                    @endif
                </x-slot>
            </x-table.table>
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

            @include('livewire.team._event-selection')

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
