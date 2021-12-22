<div>
    <x-headings.page>
        Team Announcements
        <x-slot name="action">
            @can('coach')
            <x-button.primary wire:click="showFormModal">
                <x-icon.plus class="mr-2"/> New Announcement
            </x-button.primary>
        @endcan
        </x-slot>
    </x-headings.page>

    <div class="min-h-screen">
        <div class="grid grid-cols-2 gap-4 lg:gap-8">
            <div class="col-span-2 md:col-span-1">
                <ul class="space-y-4 w-full">
                    @forelse($announcements as $announcement)
                    @include('livewire.communication._team-announcement-card')
                    @include('livewire.communication._confirm-delete-modal')

                    @empty
                        <x-empty-record-card model="Announcement">
                            <x-slot name="icon">
                                <x-icon.megaphone />
                            </x-slot>
                        </x-empty-record-card>
                    @endforelse
                </ul>
            </div>
            <div class="hidden md:block md:col-span-1">
                <x-card.card-with-header>
                    <x-slot name="header">
                        Preview
                    </x-slot>
                    @if($displayedAnnouncement)
                        <div class="flex flex-col">
                            <div class="text-xl font-medium text-red-900">{{ $displayedAnnouncement->title }}</div>
                            <div class="py-2 h-full no-tailwindcss-base">{!! $displayedAnnouncement->body !!}</div>
                            <div class="text-xs text-gray-400">
                                @if($displayedAnnouncement->updated_at > $displayedAnnouncement->created_at)
                                    updated
                                @else
                                    posted
                                @endif
                                {{ $displayedAnnouncement->updated_at->diffForHumans() }}
                                by {{ $displayedAnnouncement->owner->name }} </div>
                        </div>

                    @endif
                </x-card.card-with-header>
            </div>

        </div>

    </div>

    @include('livewire.communication._team-announcement-form-modal')


</div>
