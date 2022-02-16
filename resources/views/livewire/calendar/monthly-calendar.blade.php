<div class="flex w-full">
    <div class="hidden md:flex w-full justify-center">
        <livewire:calendar.team-events-calendar
            before-calendar-view="livewire/calendar/_calendar-heading"
        />
    </div>
    <div class="flex flex-col w-full md:hidden">
        <x-headings.page>
            Team Events
        </x-headings.page>
        <ul class="flex flex-col w-full space-y-2">
            @foreach($events as $event)
                <li wire:key="{{ $loop->index }}"  class="w-full">
                    <x-card.basic wire:click="showMobileModal({{ $event->id }})">
                        <div class="flex flex-col">
                            <div class="flex text-sm text-gray-400 font-semibold justify-center w-full">
                                {{ $event->event_date->format('F j') }}
                            </div>
                            <div class="text-sm font-bold text-red-800 py-1">
                                {{ $event->title }}
                            </div>
                            <hr>
                            <div class="py-2 text-sm text-gray-600 line-clamp-2">
                                {!! $event->description !!}
                            </div>
                        </div>
                    </x-card.basic>
                </li>
            @endforeach
        </ul>

    </div>



    @if($teamEvent)
        <x-modal.dialog wire:model="showEventModal">
            <x-slot name="title">
                {{ $teamEvent->event_date->format('F j') }}
            </x-slot>
            <x-slot name="content">
                <div class="font-bold text-red-800">
                    {{ $teamEvent->title }}
                </div>

                <div class="py-2 no-tailwindcss-base">
                    {!! $teamEvent->description !!}
                </div>

            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="hideModal">Dismiss</x-button.secondary>
            </x-slot>

        </x-modal.dialog>
    @endif

</div>
