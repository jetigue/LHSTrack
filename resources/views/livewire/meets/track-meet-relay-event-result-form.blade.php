<div>
    <x-form wire:submit.prevent="submitForm" action="/track/meets/relay-event-results">

        <div class="flex space-x-2">
            <x-input.group for="place" label="Place" :error="$errors->first('place')">
                <x-input.text
                    wire:model.defer="place"
                    type="number"
                    min="1"
                >
                </x-input.text>
            </x-input.group>

            <x-input.group for="relay_team" label="Relay Team" :error="$errors->first('relay_team')">
                <x-input.select wire:model="relay_team">
                    <option value="">Relay Team</option>
                    @foreach(range('A','Z') as $relay_team)
                        <option value="{{ $relay_team }}">{{ $relay_team }}</option>
                    @endforeach
                </x-input.select>
            </x-input.group>

            <x-input.group for="heat" label="Heat" :error="$errors->first('heat')">
                <x-input.text
                    wire:model.defer="heat"
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

        </div>

        <div class="flex space-x-2">
            <div class="flex w-1/2">
                <x-input.group for="leg_1_athlete_id" label="1st Leg" :error="$errors->first('leg_1_athlete_id')">
                    <x-input.select wire:model="leg_1_athlete_id">
                        <option value="">Name...</option>
                        @if( $this->gender_id == 1 )
                        @foreach($athletes->where('sex', 'm') as $athlete)
                            <option value="{{ $athlete->id }}">
                                {{ $athlete->fullName }}
                            </option>
                        @endforeach
                        @elseif( $this->gender_id == 2)
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
             </div>


            <div class="flex">

{{--                        @if ($trackEvent->distance_in_meters / 4 > 200)--}}
                        <x-input.group for="leg_1_minutes" label="Minutes" :error="$errors->first('leg_1_minutes')">
                            <x-input.text
                                wire:model.defer="leg_1_minutes"
                                type="number"
                                min="0"
                            >
                            </x-input.text>
                        </x-input.group>
{{--                        @endif--}}

                        <x-input.group for="leg_1_seconds" label="Seconds" :error="$errors->first('leg_1_seconds')">
                            <x-input.text
                                leading-add-on=":"
                                wire:model.defer="leg_1_seconds"
                                type="number"
                                min="0"
                                max="59"
                                placeholder="ss"
                            >
                            </x-input.text>
                        </x-input.group>
                            <x-input.group for="leg_1_milliseconds" label="ms" :error="$errors->first('leg_1_milliseconds')">
                                <x-input.text
                                    leading-add-on="."
                                    wire:model.defer="leg_1_milliseconds"
                                    type="number"
                                    min="0"
                                    max="99"
                                >
                                </x-input.text>
                        </x-input.group>
                    </div>
        </div>






        <x-input.group for="leg_2_athlete_id" label="2nd Leg" :error="$errors->first('leg_2_athlete_id')">
            <x-input.select wire:model="leg_2_athlete_id">
                <option value="">Name...</option>
                @if( $this->gender_id == 1 )
                @foreach($athletes->where('sex', 'm') as $athlete)
                    <option value="{{ $athlete->id }}">
                        {{ $athlete->fullName }}
                    </option>
                @endforeach
                @elseif( $this->gender_id == 2)
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

        <x-input.group for="leg_3_athlete_id" label="3rd Leg" :error="$errors->first('leg_3_athlete_id')">
            <x-input.select wire:model="leg_3_athlete_id">
                <option value="">Name...</option>
                @if( $this->gender_id == 1 )
                @foreach($athletes->where('sex', 'm') as $athlete)
                    <option value="{{ $athlete->id }}">
                        {{ $athlete->fullName }}
                    </option>
                @endforeach
                @elseif( $this->gender_id == 2)
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

        <x-input.group for="leg_4_athlete_id" label="4th Leg" :error="$errors->first('leg_4_athlete_id')">
            <x-input.select wire:model="leg_4_athlete_id">
                <option value="">Name...</option>
                @if( $this->gender_id == 1 )
                @foreach($athletes->where('sex', 'm') as $athlete)
                    <option value="{{ $athlete->id }}">
                        {{ $athlete->fullName }}
                    </option>
                @endforeach
                @elseif( $this->gender_id == 2)
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



        <div class="flex space-x-3">
            @if ($trackEvent->distance_in_meters / 4 > 200)
            <x-input.group for="leg_2_minutes" label="Minutes" :error="$errors->first('leg_2_minutes')">
                <x-input.text
                    wire:model.defer="leg_2_minutes"
                    type="number"
                    min="0"
                >
                </x-input.text>
            </x-input.group>
            @endif

            <x-input.group for="leg_2_seconds" label="Seconds" :error="$errors->first('leg_2_seconds')">
                <x-input.text
                    leading-add-on=":"
                    wire:model.defer="leg_2_seconds"
                    type="number"
                    min="0"
                    max="59"
                >
                </x-input.text>
            </x-input.group>
                <x-input.group for="leg_2_milliseconds" label="ms" :error="$errors->first('leg_2_milliseconds')">
                    <x-input.text
                        leading-add-on="."
                        wire:model.defer="leg_2_milliseconds"
                        type="number"
                        min="0"
                        max="99"
                    >
                    </x-input.text>
            </x-input.group>
        </div>

        <div class="flex space-x-3">
            @if ($trackEvent->distance_in_meters > 200)
            <x-input.group for="leg_3_minutes" label="Minutes" :error="$errors->first('leg_3_minutes')">
                <x-input.text
                    wire:model.defer="leg_3_minutes"
                    type="number"
                    min="0"
                >
                </x-input.text>
            </x-input.group>
            @endif

            <x-input.group for="leg_3_seconds" label="Seconds" :error="$errors->first('leg_3_seconds')">
                <x-input.text
                    leading-add-on=":"
                    wire:model.defer="leg_3_seconds"
                    type="number"
                    min="0"
                    max="59"
                >
                </x-input.text>
            </x-input.group>
                <x-input.group for="leg_3_milliseconds" label="ms" :error="$errors->first('leg_3_milliseconds')">
                    <x-input.text
                        leading-add-on="."
                        wire:model.defer="leg_3_milliseconds"
                        type="number"
                        min="0"
                        max="99"
                    >
                    </x-input.text>
            </x-input.group>
        </div>

        <div class="flex space-x-3">
            @if ($trackEvent->distance_in_meters > 200)
            <x-input.group for="leg_4_minutes" label="Minutes" :error="$errors->first('leg_4_minutes')">
                <x-input.text
                    wire:model.defer="leg_4_minutes"
                    type="number"
                    min="0"
                >
                </x-input.text>
            </x-input.group>
            @endif

            <x-input.group for="leg_4_seconds" label="Seconds" :error="$errors->first('leg_4_seconds')">
                <x-input.text
                    leading-add-on=":"
                    wire:model.defer="leg_4_seconds"
                    type="number"
                    min="0"
                    max="59"
                >
                </x-input.text>
            </x-input.group>
                <x-input.group for="leg_4_milliseconds" label="ms" :error="$errors->first('leg_4_milliseconds')">
                    <x-input.text
                        leading-add-on="."
                        wire:model.defer="leg_4_milliseconds"
                        type="number"
                        min="0"
                        max="99"
                    >
                    </x-input.text>
            </x-input.group>
        </div>

    </x-form>
</div>
