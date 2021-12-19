<div>
<x-headings.page>
    Roster
</x-headings.page>

<x-card.card-with-header>
    <x-slot name="header">
        {{ $this->gender }} Roster
    </x-slot>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 px-8 bg-white">
        <div class="col-span-1">
            <x-list.ul>
                <x-slot name="heading">Seniors</x-slot>
                @foreach($seniors as $senior)
                    <li>{{ $senior->last_name }}, {{ $senior->first_name }}</li>
                @endforeach
            </x-list.ul>
        </div>

        <div class="col-span-1">
            <x-list.ul>
                <x-slot name="heading">Juniors</x-slot>
                @foreach($juniors as $junior)
                    <li>{{ $junior->last_name }}, {{ $junior->first_name }}</li>
                @endforeach
            </x-list.ul>
        </div>

        <div class="col-span-1">
            <x-list.ul>
                <x-slot name="heading">Sophomores</x-slot>
                @foreach($sophomores as $sophomore)
                    <li>{{ $sophomore->last_name }}, {{ $sophomore->first_name }}</li>
                @endforeach
            </x-list.ul>
        </div>

        <div class="col-span-1">
            <x-list.ul>
                <x-slot name="heading">Freshmen</x-slot>
                @foreach($freshmen as $freshman)
                    <li>{{ $freshman->last_name }}, {{ $freshman->first_name }}</li>
                @endforeach
            </x-list.ul>
        </div>
    </div>
</x-card.card-with-header>
</div>
