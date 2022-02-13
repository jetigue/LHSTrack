<div>

    <x-headings.page>
        <div class="flex items-baseline space-x-8">
            <div>
                {{ $athlete->first_name }} {{ $athlete->last_name }}
            </div>
            <div class="text-gray-400 text-base">
                {{ $athlete->grade }}
            </div>
        </div>
    </x-headings.page>

    <div class="w-full space-y-10">
        @if ($runningTrackEvents != null)
            <div>
                @include('livewire.athletes._profile-running-results')
            </div>

        @endif
        @if ($fieldTrackEvents != null)
            <div>
                @include('livewire.athletes._profile-field-results')
            </div>
        @endif
    </div>
</div>
