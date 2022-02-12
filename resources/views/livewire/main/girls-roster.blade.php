<div class="px-2 md:px-0">
    <x-headings.page>
        {{ $this->gender }} Roster
    </x-headings.page>

    <div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 lg:px-8 font-semibold">
            <div class="col-span-1">
                <x-list.ul>
                    <x-slot name="heading">Seniors</x-slot>
                    @foreach($seniors as $senior)
                        <li class="text-{{ $senior->status_color }}-500">
                            <a class="hover:underline" href="{{ $senior->path() }}">{{ $senior->last_name }}
                                , {{ $senior->first_name }}</a>
                        </li>
                    @endforeach
                </x-list.ul>
            </div>

            <div class="col-span-1">
                <x-list.ul>
                    <x-slot name="heading">Juniors</x-slot>
                    @foreach($juniors as $junior)
                        <li class="text-{{ $junior->status_color }}-500">
                            <a class="hover:underline" href="{{ $junior->path() }}">{{ $junior->last_name }}
                                , {{ $junior->first_name }}</a>
                        </li>
                    @endforeach
                </x-list.ul>
            </div>

            <div class="col-span-1">
                <x-list.ul>
                    <x-slot name="heading">Sophomores</x-slot>
                    @foreach($sophomores as $sophomore)
                        <li class="text-{{ $sophomore->status_color }}-500">
                            <a class="hover:underline" href="{{ $sophomore->path() }}">{{ $sophomore->last_name }}
                                , {{ $sophomore->first_name }}</a>
                        </li>
                    @endforeach
                </x-list.ul>
            </div>

            <div class="col-span-1">
                <x-list.ul>
                    <x-slot name="heading">Freshmen</x-slot>
                    @foreach($freshmen as $freshman)
                        <li class="text-{{ $freshman->status_color }}-500">
                            <a class="hover:underline" href="{{ $freshman->path() }}">{{ $freshman->last_name }}
                                , {{ $freshman->first_name }}</a>
                        </li>
                    @endforeach
                </x-list.ul>
            </div>
        </div>
    </div>
</div>
