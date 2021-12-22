<div>
<x-headings.page>
    {{ $this->gender }} Roster
</x-headings.page>

<div>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 lg:px-8 font-semibold">
        <div class="col-span-1">
            <x-list.ul>
                <x-slot name="heading">Seniors</x-slot>
                @foreach($seniors as $senior)
                    <li class="text-{{ $senior->status_color }}-500">{{ $senior->last_name }}, {{ $senior->first_name }}</li>
                @endforeach
            </x-list.ul>
        </div>

        <div class="col-span-1">
            <x-list.ul>
                <x-slot name="heading">Juniors</x-slot>
                @foreach($juniors as $junior)
                    <li class="text-{{ $junior->status_color }}-500">{{ $junior->last_name }}, {{ $junior->first_name }}</li>
                @endforeach
            </x-list.ul>
        </div>

        <div class="col-span-1">
            <x-list.ul>
                <x-slot name="heading">Sophomores</x-slot>
                @foreach($sophomores as $sophomore)
                    <li class="text-{{ $sophomore->status_color }}-500">{{ $sophomore->last_name }}, {{ $sophomore->first_name }}</li>
                @endforeach
            </x-list.ul>
        </div>

        <div class="col-span-1">
            <x-list.ul>
                <x-slot name="heading">Freshmen</x-slot>
                @foreach($freshmen as $freshman)
                    <li class="text-{{ $freshman->status_color }}-500">{{ $freshman->last_name }}, {{ $freshman->first_name }}</li>
                @endforeach
            </x-list.ul>
        </div>
    </div>
</div>
</div>
