<x-card.card-with-header>
    <x-slot name="header">
        Announcements
    </x-slot>
    <div class="md:hidden max-h-64 overflow-y-auto">
        <ul class="divide-y divide-gray-200">
            @foreach($announcements as $announcement)
            <li wire:key="{{ $loop->index }}">
                <p class="text-xl font-medium text-red-900">{{ $announcement->title }}</p>
                   <div class="py-2 h-full">{!! $announcement->body !!}</div>
                   <p class="text-xs text-gray-400 self-end content-end">
                       @if($announcement->updated_at > $announcement->created_at)
                           updated
                       @else
                           posted
                       @endif
                       {{ $announcement->updated_at->diffForHumans() }}
                       by {{ $announcement->owner->name }} </p>
            @endforeach
            </li>
        </ul>
    </div>

    <div class="hidden md:flex flex-col">
        <div class="flex divide-x space-x-6">
            <section id="announcement-previews" class="w-1/3">
                <div class="flow-root md:h-72 lg:h-96 overflow-y-auto">
                    <ul class="divide-y divide-gray-200">
                        @foreach($announcements as $announcement)
                            <li wire:key="{{ $loop->index }}"
                                wire:click="displayAnnouncement({{ $announcement->id }})"
                                class="py-4 px-2 rounded-md cursor-pointer hover:bg-black hover:text-white">
                                <div class="text-md font-semibold truncate">{{ $announcement->title }}</div>
                                <p class="text-sm line-clamp-2">
                                    {{ substr(strip_tags($announcement->body), 0) }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-8">
                    @can('admin')
                    <a href="{{ route('Team Announcements') }}"
                       class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        View All
                    </a>
                        @endcan
                </div>
            </section>

            <section id="announcement-featured" class="flex flex-col w-2/3 px-6">
                @if($displayedAnnouncement)
                    <div class="flex flex-col md:h-72 lg:h-96 overflow-y-auto">
                <p class="text-xl font-medium text-red-900">{{ $displayedAnnouncement->title }}</p>
                <div class="py-2 h-full no-tailwindcss-base">{!! $displayedAnnouncement->body !!}</div>
                <p class="text-xs text-gray-400 self-end content-end">
                    @if($displayedAnnouncement->updated_at > $displayedAnnouncement->created_at)
                        updated
                    @else
                        posted
                    @endif
                    {{ $displayedAnnouncement->updated_at->diffForHumans() }}
                    by {{ $displayedAnnouncement->owner->name }} </p>
                    @endif
                    </div>
            </section>
        </div>
    </div>
</x-card.card-with-header>

