<div class="pt-5">
    <div class="flex w-full justify-between items-center flex-wrap">
        <div class="flex w-full md:w-1/2 text-gray-500 text-2xl font-medium">
            Announcements
        </div>
        @can('coach')
            <div class="flex w-full md:w-64 text-gray-800 py-3">
                <x-input.select wire:model="announcementTimeFrame">
                    <option value=">=">Upcoming Announcements</option>
                    <option value="<">Past Announcements</option>
                    <option value="">All Announcements</option>
                </x-input.select>
            </div>

            <div>
                <x-button.primary wire:click="addAnnouncement">
                    <x-icon.plus />
                    New
                </x-button.primary>
            </div>
        @endcan
    </div>
    <x-card.basic>
        <div class="md:hidden max-h-56 overflow-y-auto">
            <ul class="divide-y divide-gray-200">
                @foreach($announcements->sortByDesc('updated_at') as $announcement)
                    <li wire:key="{{ $loop->index }}">
                        <p class="text-xl font-medium text-red-900">{{ $announcement->title }}</p>
                        <div class="flex flex-col py-2 h-full">{!! $announcement->body !!}</div>
                        <div class="text-xs text-gray-400 self-end content-end">
                            @if($announcement->updated_at > $announcement->created_at)
                                updated
                            @else
                                posted
                            @endif
                            {{ $announcement->updated_at->diffForHumans() }}
                            by {{ $announcement->owner->name }}
                        </div>
                    </li>
{{--                @empty--}}
{{--                    <x-no-records missing-record="{{ $this->whichAnnouncements }} Announcements" />--}}
                @endforeach
            </ul>
        </div>

        <div class="hidden md:flex flex-col">
            <div class="flex divide-x space-x-6 relative">
                <section id="announcement-previews" class="w-1/3">
                    <div class="flow-root h-56 overflow-y-auto -mr-4">
                        <ul class="divide-y divide-gray-200">
                            @foreach($announcements->sortByDesc('updated_at') as $announcement)
                                <li wire:key="{{ $loop->index }}"
                                    wire:click="displayAnnouncement({{ $announcement->id }})"
                                    class="py-4 px-2 rounded-md cursor-pointer hover:bg-black hover:text-white">
                                    <div class="flex justify-between">
                                        <div class="text-md font-semibold truncate">{{ $announcement->title }}</div>
                                        @can('coach')
                                            <x-dropdown.dropdown>
                                                <x-slot name="trigger">
                                                    <x-icon.dots-vertical
                                                        class="text-gray-300 hover:text-red-700" />
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-dropdown.link
                                                        wire:click="editAnnouncement({{ $announcement->id }})">
                                                        Edit
                                                    </x-dropdown.link>
                                                    <x-dropdown.link
                                                        wire:click="confirmDeleteAnnouncement({{ $announcement->id }})">
                                                        Delete
                                                    </x-dropdown.link>
                                                </x-slot>
                                            </x-dropdown.dropdown>
                                        @endcan
                                    </div>

                                    <p class="text-sm line-clamp-2">
                                        {{ substr(strip_tags($announcement->body), 0) }}
                                    </p>
                                    <div class="py-1">
                                        @can('coach')
                                            @if ($announcement->end_date < \Carbon\Carbon::now())
                                                <div class="text-red-500 font-semibold text-xs">
                                                    Expired {{ $announcement->end_date->diffForHumans() }}
                                                </div>
                                            @else
                                                <div class="text-green-500 font-semibold text-xs">
                                                    Expires {{ $announcement->end_date->diffForHumans() }}
                                                </div>
                                            @endif
                                        @endcan
                                    </div>
                                    <div>

                                    </div>
                                </li>
{{--                            @empty--}}
{{--                                <x-no-records missing-record="{{ $this->whichAnnouncements }} Announcements" />--}}
                            @endforeach
                        </ul>
                    </div>
                </section>

                <section id="announcement-featured" class="flex flex-col w-2/3 px-6">
                    @if($displayedAnnouncement)
                        <div class="flex flex-col h-56 overflow-y-auto -mr-6">
                            <p class="text-xl font-medium text-red-900">{{ $displayedAnnouncement->title }}</p>
                            <div
                                class="py-2 h-full no-tailwindcss-base">{!! $displayedAnnouncement->body !!}</div>
                            <div
                                class="text-xs text-gray-400 w-full text-right pr-2">
                                @if($displayedAnnouncement->updated_at > $displayedAnnouncement->created_at)
                                    updated
                                @else
                                    posted
                                @endif
                                {{ $displayedAnnouncement->updated_at->diffForHumans() }}
                                by {{ $displayedAnnouncement->owner->name }}
                            </div>
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </x-card.basic>
</div>
