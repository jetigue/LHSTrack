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
        @if (count($runningEventResults->where('athlete_id', $this->athlete->id)) > 0)
            <div>
                @include('livewire.athletes._profile-running-results')
            </div>

        @endif
        @if (count($fieldEventResults->where('athlete_id', $this->athlete->id)) > 0)
            <div>
                @include('livewire.athletes._profile-field-results')
            </div>
        @endif
    </div>
</div>
