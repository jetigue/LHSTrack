<x-table.row
    x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
    wire:loading.class.delay="opacity-50"
>
    <x-table.cell class="flex w-6/12 md:w-4/12 lg:w-1/4 truncate">
        {{ $athlete->fullname }}
    </x-table.cell>

    <x-table.cell class="hidden md:flex md:w-3/12 lg:w-1/6 justify-center">
        <x-training-pace :athlete="$athlete" distance="1609.344" :percentVO2="$percentVO2" />
    </x-table.cell>

    <x-table.cell class="hidden md:flex md:w-3/12 lg:w-1/6 justify-center">
        <x-training-pace :athlete="$athlete" distance="400" :percentVO2="$percentVO2" />
    </x-table.cell>

    <x-table.cell class="hidden lg:flex lg:w-1/6 justify-center">
        <x-training-pace :athlete="$athlete" distance="800" :percentVO2="$percentVO2" />
    </x-table.cell>

    <x-table.cell class="hidden md:flex md:w-3/12 lg:w-1/6 justify-center">
        <x-training-pace :athlete="$athlete" distance="1000" :percentVO2="$percentVO2" />
    </x-table.cell>

    <x-table.cell class="hidden lg:flex lg:w-1/6 justify-center">
        <x-training-pace :athlete="$athlete" distance="1600" :percentVO2="$percentVO2" />
    </x-table.cell>

    <x-table.cell class="absolute right-1 md:right-2 lg:right-4">
        <x-dropdown.dropdown width="72">
            <x-slot name="trigger">
                <x-icon.dots-vertical class="text-gray-300 hover:text-red-700" />
            </x-slot>
            <x-slot name="content">
                <div class="flex flex-col p-4">
                    <div class="flex border-b-2 border-red-800">
                        <div class="flex flex-col text-sm text-gray-400 flex-wrap text-center w-3/4 pb-2">
                            <div>
                                Based on a <span
                                    class="text-red-800 px-1"> {{ $athlete->bestPerformance->time }}</span> {{ $athlete->bestPerformance->trackEvent->name }}
                            </div>
                            <div>
                                {{ $athlete->bestPerformance->teamResult->trackMeet->meetName->name }}
                            </div>
                            <div>
                                {{ $athlete->bestPerformance->teamresult->trackMeet->meet_date->diffForHumans() }}
                            </div>
                        </div>
                        <div class="flex justify-center items-start text-center">
                            <div class="flex flex-col shadow bg-gray-50 text-red-800 rounded-md px-2 py-1">
                                {{ $athlete->bestPerformance->vdot }}
                                <span class="text-xs font-light">VDOT</span>
                            </div>

                        </div>
                    </div>

                    <div class="flex space-x-4 pt-2">
                        <div class="flex flex-col">
                            <ol class="space-y-1.5">
                                <li>2 mi</li>
                                <li>3 mi</li>
                                <li>5k</li>
                                <li>5 mi</li>
                                <li>10 mi</li>
                                <li>13.1 mi</li>
                                <li>26.2 mi</li>
                            </ol>
                        </div>
                        <div class="flex flex-col">
                            <ol class="space-y-1.5">
                                <li>
                                    <x-training-pace :athlete="$athlete" distance="3218.688"
                                                     :percentVO2="$percentVO2" />
                                </li>
                                <li>
                                    <x-training-pace :athlete="$athlete" distance="4828.032"
                                                     :percentVO2="$percentVO2" />
                                </li>
                                <li>
                                    <x-training-pace :athlete="$athlete" distance="5000" :percentVO2="$percentVO2" />
                                </li>
                                <li>
                                    <x-training-pace :athlete="$athlete" distance="8046.72" :percentVO2="$percentVO2" />
                                </li>
                                <li>
                                    <x-training-pace :athlete="$athlete" distance="16093.4" :percentVO2="$percentVO2" />
                                </li>
                                <li>
                                    <x-training-pace :athlete="$athlete" distance="21082.41"
                                                     :percentVO2="$percentVO2" />
                                </li>
                                <li>
                                    <x-training-pace :athlete="$athlete" distance="42164.81"
                                                     :percentVO2="$percentVO2" />
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
            </x-slot>
        </x-dropdown.dropdown>
    </x-table.cell>
</x-table.row>
