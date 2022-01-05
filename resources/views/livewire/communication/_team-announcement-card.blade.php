@php
 if ($announcement->id === $displayedAnnouncement->id) {
    $borderColor = 'red-800';
}
@endphp


<li wire:key="{{ $loop->index }}"
    class="relative w-full bg-{{ $announcement->cardColor }} shadow rounded-md p-4 md:border-l-8 border-{{ $announcement->cardColor }} border-{{ $borderColor }}"
    wire:click="previewAnnouncement({{ $announcement->id }})"
>
    @can('coach')
    <div class="flex absolute justify-between top-2 right-2 z-10">
        <div class="p-1">
            <x-dropdown.dropdown>
                <x-slot name="trigger">
                    <x-icon.dots-vertical class="text-gray-300 hover:text-red-800"/>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown.link wire:click="editAnnouncement( {{$announcement->id}} )">
                        Edit
                    </x-dropdown.link>
                    <x-dropdown.link wire:click="confirmDelete( {{ $announcement->id }} )">
                        Delete
                    </x-dropdown.link>
                </x-slot>
            </x-dropdown.dropdown>
        </div>
    </div>
    @endcan
    <div class="flex w-full items-center">
        <div class="flex w-3/4 text-red-900 font-semibold">
            {{ $announcement->title }}
        </div>
        @if ($announcement->expired())
            <div class="flex w-1/4 justify-center text-red-400 text-sm font-bold">
                Expired
            </div>
        @endif
    </div>

    <div class="py-2" x-data="{ open: false }">
        <div class="line-clamp-1 text-sm text-gray-600 w-full lg:w-5/6">
            {{ strip_tags($announcement->body) }}
        </div>
        <button @click="open = !open" type="button" class="md:hidden text-sm font-semibold text-blue-600 hover:text-blue-700">
            <span x-show="!open">Show More</span>
            <span x-show="open">Show Less</span>
        </button>
            <div x-show="open"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="-translate-y-full"
             class="border-b lg:hidden mb-4"
             id="mobile-announcement"
        >
        <div class="py-2 h-full no-tailwindcss-base">
            {!! $displayedAnnouncement->body !!}
        </div>
    </div>

    <div class="flex flex-wrap justify-between items-center mt-2">
        <div class="flex text-sm text-gray-400 items-center">
            <x-icon.calendar class="h-4 w-4 text-gray-400 mr-2"/>
            <span class="mr-1">
                @if ($announcement->expired())
                    Ended on
                @else
                    Ends on
                @endif
                    </span> {{ $announcement->end_date->format('F d, Y') }}
        </div>
        <div class="flex text-gray-400 text-xs font-medium md:py-1">
                <span class="pr-1">
                    @if($announcement->updated_at > $announcement->created_at)
                        updated
                    @else
                        created
                    @endif
                </span>
            {{ $announcement->updated_at->diffForHumans() }} by {{ $announcement->owner->name }}
        </div>
    </div>
</li>
