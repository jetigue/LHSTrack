<div>
    <x-headings.page>
        <x-slot name="breadcrumbs">
            <x-breadcrumb.menu>
                <x-breadcrumb.item href="{{ route('Dashboard') }}" :leadingArrow="false">
                    Dashboard
                </x-breadcrumb.item>
            </x-breadcrumb.menu>
        </x-slot>
        Distance Training Paces
    </x-headings.page>

    <div class="grid grid-cols-6 gap-6 lg:gap-8 items-start">
        <div class="grid col-span-6 md:col-span-4 order-2 md:order-1 space-y-2">
            <div class="text-gray-300 text-lg">
                Showing All Athlete's Easy Pace
            </div>
            <x-table.table class="table-fixed relative">
                <x-slot name="head">
                    <x-table.header-row class="flex w-full">
                        <x-table.heading class="flex w-6/12 md:w-4/12 lg:w-3/12">
                            Athlete
                        </x-table.heading>
                        <x-table.heading class="flex w-5/12 md:w-1/4 lg:w-1/6 justify-center">
                            Pace
                        </x-table.heading>
                        <x-table.heading class="hidden md:flex md:w-3/12 lg:w-1/6 justify-center">
                            400m
                        </x-table.heading>
                        <x-table.heading class="hidden lg:flex lg:w-1/6 justify-center">
                            800m
                        </x-table.heading>
                        <x-table.heading class="hidden md:flex md:w-3/12 lg:w-1/6 justify-center">
                            1K
                        </x-table.heading>
                        <x-table.heading class="hidden lg:flex lg:w-1/6 justify-center">
                            1600m
                        </x-table.heading>
                    </x-table.header-row>
                </x-slot>

                <x-slot name="body">
                    @if ($this->filteredSex)
                        @foreach($athletes->where('sex', $this->sex) as $athlete)
                            <livewire:training.paces.show-athlete-daniels-training-paces
                                :athlete="$athlete"
                                :percent-v-o2="$percentVO2"
                                wire:key="{{ $loop->index }}"
                            />
                        @endforeach
                    @else
                        @foreach($athletes as $athlete)
                            <livewire:training.paces.show-athlete-daniels-training-paces
                                :athlete="$athlete"
                                :percent-v-o2="$percentVO2"
                                wire:key="{{ $loop->index }}"
                            />
                        @endforeach
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

            <x-input.group for="pace" label="Intensity">
                <x-input.select wire:model="percentVO2">
                    <option value=".67">Easy</option>
                    <option value=".60">Very Easy</option>
                    <option value=".74">Moderately Easy</option>
                    <option value=".80">Marathon</option>
                    <option value=".825">Steady State</option>
                    <option value=".87">Threshold</option>
                    <option value=".90">Critical Velocity</option>
                    <option value=".975">Interval</option>
                    <option value="1.1">Repetition</option>
                </x-input.select>
            </x-input.group>

            <x-input.group for="sex" label="Sex">
                <x-input.select wire:model="sex">
                    <option value="">All</option>
                    <option value="m">Boys</option>
                    <option value="f">Girls</option>
                </x-input.select>
            </x-input.group>

            <x-input.group for="units" label="Units">
                <x-input.select wire:model="units">
                    <option value="meters">Meters</option>
                    <option value="miles">Miles</option>
                </x-input.select>
            </x-input.group>
        </div>
    </div>
</div>
