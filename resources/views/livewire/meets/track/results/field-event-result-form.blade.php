<div>
    <x-form wire:submit.prevent="submitForm" action="/track/meets/field-event-results">

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
                @if( $this->teamResult->division->gender_id == 1 )
                    @foreach($athletes->where('sex', 'm') as $athlete)
                        <option value="{{ $athlete->id }}">
                            {{ $athlete->fullName }}
                        </option>
                    @endforeach
                @elseif( $this->teamResult->division->gender_id == 2)
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
            <x-input.group for="feet" label="Feet" :error="$errors->first('feet')">
                <x-input.text
                    wire:model.defer="feet"
                    type="number"
                    min="1"
                >
                </x-input.text>
            </x-input.group>

            <x-input.group for="inches" label="Inches" :error="$errors->first('inches')">
                <x-input.text
                    wire:model.defer="inches"
                    type="number"
                    min="0"
                    max="11"
                >
                </x-input.text>
            </x-input.group>

            <x-input.group for="quarter_inch" label="Fraction"
                           :error="$errors->first('quarter_inch')">
                <x-input.select wire:model="quarter_inch">
                    <option value=0>0</option>
                    <option value=1>.25</option>
                    <option value=2>.50</option>
                    <option value=3>.75</option>
                </x-input.select>
            </x-input.group>
        </div>

        <x-input.group for="flight" label="Flight" :error="$errors->first('flight')">
            <x-input.text
                wire:model.defer="flight"
                type="number"
                min="1"
            >
            </x-input.text>
        </x-input.group>

        <x-input.group for="points" label="Points" :error="$errors->first('points')">
            <x-input.text
                wire:model.defer="points"
                type="number"
            >
            </x-input.text>
        </x-input.group>
    </x-form>
</div>
