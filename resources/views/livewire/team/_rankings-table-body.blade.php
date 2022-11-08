<x-table.row class="flex justify-between ">
    <x-table.cell class="flex w-2/12 md:w-1/12 text-sm md:text-base justify-center">
        {{ $this->rank++ }}
    </x-table.cell>
    <x-table.cell class="flex-col w-4/12 lg:w-2/12 items-baseline text-sm md:text-base justify-center">
        @if ($this->showRunningEvent)
            {{ ltrim(floor($bestTime->total_time) > 59 ? gmdate('i:s', floor($bestTime->total_time)) : gmdate('s', floor($bestTime->total_time)), 0) }}
            <span class="text-xs">.{{ explode('.', number_format($bestTime->total_time, 2))[1]}}</span>
            @switch($bestTime->athlete->grad_year - $this->year)
                @case(0)
                    @if($bestTime->total_time < 13.00)
                        <div class="text-xs font-semibold text-green-500 -mt-1">Lettered</div>
                        @endif
            @break
            @endswitch

        @elseif ($this->showFieldEvent)
            {{ $bestTime->mark }}
            <span class="text-xs">
                {{$bestTime->fraction }}
            </span>
            "
        @endif
    </x-table.cell>
    <x-table.cell class="flex w-6/12 lg:w-3/12 text-sm md:text-base">
        <a href="{{ $bestTime->athlete->path() }}" class="hover:underline">
            {{ $bestTime->athlete->last_name }}, {{ $bestTime->athlete->first_name }}
        </a>
    </x-table.cell>

    <x-table.cell class="hidden lg:flex  lg:w-2/12 text-sm md:text-base">
        @switch($bestTime->athlete->grad_year - $this->year)
            @case(0)
            12th
            @break
            @case(1)
            11th
            @break
            @case(2)
            10th
            @break
            @case(3)
            9th
            @break
            @default
            alum
        @endswitch
    </x-table.cell>

    <x-table.cell class="hidden lg:flex flex-col lg:w-4/12 text-sm truncate">
        <div class="">
            <a href="{{ $bestTime->teamResult->trackMeet->path() }}" class="hover:underline">
                {{ $bestTime->teamresult->trackMeet->meetName->name }}
            </a>
        </div>
        <div class="pl-4 text-xs">{{ $bestTime->teamResult->trackMeet->meet_date->format('F j, Y') }}</div>
    </x-table.cell>
    <x-table.cell class="absolute lg:hidden right-1 md:right-2 lg:right-4">
        <x-dropdown.dropdown width="72">
            <x-slot name="trigger">
                <x-icon.dots-vertical class="text-gray-300 hover:text-red-700" />
            </x-slot>
            <x-slot name="content">
                <div class="flex flex-col p-4 space-y-2">
                    <div>{{ $bestTime->teamresult->trackMeet->meetName->name }}</div>
                    <div>{{ $bestTime->teamResult->trackMeet->meet_date->format('F j, Y') }}</div>
                    <div>Grad year: {{ $bestTime->athlete->grade }}</div>
                </div>
            </x-slot>
        </x-dropdown.dropdown>
    </x-table.cell>

</x-table.row>
