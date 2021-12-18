<div>
    <x-headings.page>
        Team Announcements
        <x-slot name="action">
            @can('admin')
            <x-button.primary wire:click="showFormModal">
                <x-icon.plus class="mr-2"/> New Announcement
            </x-button.primary>
        @endcan
        </x-slot>
    </x-headings.page>

    <div class="bg-gray-100 rounded-md min-h-screen p-8">
        <div class="grid grid-cols-2 gap-8">
            <div class="col-span-1">
                <ul class="space-y-4 w-full">
                    @forelse($announcements as $announcement)
                    @include('livewire.communication._team-announcement-card')
                    @include('livewire.communication._confirm-delete-modal')

                    @empty
                            <div class="flex bg-white rounded-md p-4 w-full">
                                <div class="flex flex-col w-full text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No projects</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Get started by creating a new project.
                                    </p>

                                    <div class="mt-6">
                                        <button type="button"
                                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <!-- Heroicon name: solid/plus -->
                                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            New Project
                                        </button>
                                    </div>

                                </div>
                            </div>
                    @endforelse
                </ul>
            </div>
            <div class="col-span-1">
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

    <x-modal.dialog wire:model.defer="showFormModal">
        <x-slot name="title">
            <div x-data="{editing: @entangle('editing')}">
                <span x-show="editing === true">Edit Announcement</span>
                <span x-show="editing === false">Create an Announcement</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <livewire:communication.team-announcements-form/>
        </x-slot>

        <x-slot name="footer">
            <div x-data="{editing: @entangle('editing')}" class="flex space-x-2">
                <x-button.secondary wire:click="cancel">Cancel</x-button.secondary>
                <x-button.primary wire:click="$emit('submitCreate')">
                    <span x-show="editing === true">Save</span>
                    <span x-show="editing === false">Create</span>
                </x-button.primary>
            </div>
        </x-slot>
    </x-modal.dialog>


</div>
