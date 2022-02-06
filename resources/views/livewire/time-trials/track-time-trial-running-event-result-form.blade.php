<div>
    <x-form wire:submit.prevent="submitForm" action="/track/time-trials/running-event-results">

        <x-input.group for="place" label="Place" :error="$errors->first('place')">
            <x-input.text
                wire:model.defer="place"
                type="number"
                min="1"
            >
            </x-input.text>
        </x-input.group>

        <x-input.group for="athlete_id" label="Athlete" :error="$errors->first('athlete_id')">
            <x-input.select wire:model="athlete_id">
                <option value="">Name...</option>
                @if( $this->gender_id = 1 )
                @foreach($athletes->where('sex', 'm') as $athlete)
                    <option value="{{ $athlete->id }}">
                        {{ $athlete->fullName }}
                    </option>
                @endforeach
                @elseif( $this->gender_id = 2)
                @foreach($athletes->where('sex', 'f') as $athlete)
                    <option value="{{ $athlete->id }}">
                        {{ $athlete->fullName }}
                    </option>
                @endforeach
                @else
                @foreach( $athletes as $athlete)
                    <option value="{{ $athlete->id }}">
                        {{ $athlete->fullName }}
                    </option>
                @endforeach
                @endif
            </x-input.select>
        </x-input.group>


        <div class="flex space-x-3">
            @if ($trackEvent->distance_in_meters > 200)
            <x-input.group for="minutes" label="Minutes" :error="$errors->first('minutes')">
                <x-input.text
                    wire:model.defer="minutes"
                    type="number"
                    min="0"
                >
                </x-input.text>
            </x-input.group>
            @endif

            <x-input.group for="seconds" label="Seconds" :error="$errors->first('seconds')">
                <x-input.text
                    leading-add-on=":"
                    wire:model.defer="seconds"
                    type="number"
                    min="0"
                    max="59"
                >
                </x-input.text>
            </x-input.group>
                <x-input.group for="milliseconds" label="ms" :error="$errors->first('milliseconds')">
                    <x-input.text
                        leading-add-on="."
                        wire:model.defer="milliseconds"
                        type="number"
                        min="0"
                        max="99"
                    >
                    </x-input.text>
            </x-input.group>
        </div>

        <x-input.group for="heat" label="Heat" :error="$errors->first('heat')">
            <x-input.text
                wire:model.defer="heat"
                type="number"
                min="1"
            >
            </x-input.text>
        </x-input.group>
    </x-form>
</div>
