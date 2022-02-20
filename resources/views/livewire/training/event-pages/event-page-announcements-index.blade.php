<div x-cloak class="w-full">
    <x-link />
    <div class="flex w-full justify-between items-center flex-wrap">
        <div class="flex w-10/12 md:w-1/2 text-gray-500 text-2xl font-medium">
            Announcements
        </div>
        <div class="flex w-2/12 md:hidden justify-end pr-1">
            <x-icon.plus wire:click="showFormModal" class="text-red-800 h-8 w-8" />
        </div>
        <div class="flex w-full md:w-64 text-gray-800 py-3">
            <x-input.select wire:model="timeFrame">
                <option value=">=">Upcoming Announcements</option>
                <option value="<">Past Announcements</option>
                <option value="">All Announcements</option>
            </x-input.select>
        </div>
    </div>

    <x-card.basic>
        {{--mobile--}}
                <div class="flex md:hidden max-h-64 overflow-y-auto">
                    <ul class="flex flex-col divide-y divide-gray-200 space-y-2">
                        @foreach($announcements as $announcement)
                            <li wire:key="{{ $loop->index }}" class="py-2">
                                <div class="text-xl font-medium text-red-900">{{ $announcement->title }}</div>
                                <div class="py-2">{!! $announcement->body !!}</div>
                                <div class="text-xs text-gray-400">
                                    @if($announcement->updated_at > $announcement->created_at)
                                        updated
                                    @else
                                        posted
                                    @endif
                                    {{ $announcement->updated_at->diffForHumans() }}
                                    by {{ $announcement->owner->name }} </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

        {{-- --}}
        <div class="hidden md:flex flex-col">
            <div class="flex divide-x space-x-6 relative">
                <section id="announcement-previews" class="w-1/3">
                    <div class="flow-root h-56 overflow-y-auto -mr-4">
                        <ul class="divide-y divide-gray-200">
                            @foreach($announcements as $announcement)
                                <li wire:key="{{ $loop->index }}"
                                    wire:click="displayAnnouncement({{ $announcement->id }})"
                                    class="py-4 px-2 rounded-md cursor-pointer hover:bg-black hover:text-white"
                                >
                                    <div class="flex justify-between">
                                        <div class="text-md font-semibold truncate">
                                            {{ $announcement->title }}
                                        </div>
                                        @can('coach')
                                            <x-dropdown.dropdown>
                                                <x-slot name="trigger">
                                                    <x-icon.dots-vertical
                                                        class="text-gray-300 hover:text-red-700" />
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-dropdown.link
                                                        wire:click="edit({{ $announcement->id }})">
                                                        Edit
                                                    </x-dropdown.link>
                                                    <x-dropdown.link
                                                        wire:click="confirmDelete({{ $announcement->id }})">
                                                        Delete
                                                    </x-dropdown.link>
                                                </x-slot>
                                            </x-dropdown.dropdown>
                                        @endcan
                                    </div>

                                    <div class="text-sm line-clamp-2">
                                        {{ substr(strip_tags($announcement->body), 0) }}
                                    </div>

                                    <div class="py-1.5">
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
                                    <x-modal.confirmation wire:model.defer="showConfirmModal">
                                        <x-slot name="title">Delete Announcement?</x-slot>
                                        <x-slot name="content">Are you sure you want to delete this announcement?
                                            This cannot be
                                            undone.
                                        </x-slot>
                                        <x-slot name="footer">
                                            <x-button.tertiary
                                                wire:click="$toggle('showConfirmModal')">
                                                Cancel
                                            </x-button.tertiary>
                                            <x-button.danger
                                                wire:click="destroy({{ $announcement->id }})">
                                                Yes, Delete Announcement
                                            </x-button.danger>
                                        </x-slot>
                                    </x-modal.confirmation>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>

                <section id="announcement-featured" class="flex flex-col w-2/3 px-6 relative">
                    @can('coach')
                    <x-icon.plus wire:click="showFormModal" class="absolute right-0 top-0 -mt-3 md:-mr-4 lg:-mr-2 text-red-800 h-8 w-8" />
                    @endcan
                    @if($displayedAnnouncement)
                        <div class="flex flex-col h-56 overflow-y-auto">
                            <p class="text-xl font-medium text-red-900">{{ $displayedAnnouncement->title }}</p>
                            <div class="py-2 h-full no-tailwindcss-base">{!! $displayedAnnouncement->body !!}</div>
                            <div class="text-xs text-gray-400 w-full text-right pr-2">
                                @if($displayedAnnouncement->updated_at > $displayedAnnouncement->created_at)
                                    updated
                                @else
                                    posted
                                @endif
                                {{ $displayedAnnouncement->updated_at->diffForHumans() }}
                                by {{ $displayedAnnouncement->owner->name }}
                            </div>
                        </div>
                        @else
                        <x-no-records missing-record="Announcement"></x-no-records>
                    @endif
                </section>
            </div>
        </div>
    </x-card.basic>

    <x-modal.add-edit-record record-title="Announcement">
        <livewire:training.event-pages.event-page-announcement-form :eventSubtype="$eventSubtype" />
    </x-modal.add-edit-record>
</div>

