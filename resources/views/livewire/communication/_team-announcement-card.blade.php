@php
 if ($announcement->id === $displayedAnnouncement->id) {
    $borderColor = 'red-800';
}
@endphp


<li wire:key="{{ $loop->index }}"
    class="relative bg-white shadow rounded-md p-4 border-l-8 border-{{ $borderColor }}"
    wire:click="previewAnnouncement({{ $announcement->id }})"
>
    <div class="flex absolute justify-between top-2 right-2 z-10">
        <div class="p-1">
            <x-dropdown.dropdown>
                <x-slot name="trigger">
                    <x-icon.dots-vertical class="text-gray-300 hover:text-red-800"/>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown.link wire:click="previewAnnouncement({{ $announcement->id }})">
                        View Announcement
                    </x-dropdown.link>
                    <div class="px-2">
                        <hr>
                    </div>
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
    <div class="flex">
        <a class="font-medium hover:underline"
           href="/communication/announcements/{{ $announcement->id }}"
        >
            {{ $announcement->title }}
        </a>
    </div>

    <div class="py-2">
        <div class="line-clamp-1 text-sm text-gray-600 w-full lg:w-5/6">
            {{ strip_tags($announcement->body) }}
        </div>
    </div>

    <div class="flex justify-between items-baseline mt-2">
        <div class="flex text-sm text-gray-400 items-center">
            <x-icon.calendar class="h-4 w-4 text-gray-400 mr-2"/>
            <span class="mr-1">
                @if($announcement->end_date >= \Carbon\Carbon::now())
                    Ends on
                @else
                    Ended on
                @endif
                    </span> {{ $announcement->end_date->format('F d, Y') }}
        </div>
        <div class="text-gray-400 text-xs font-medium">
                <span>
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
