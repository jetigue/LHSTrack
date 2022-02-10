<div>
    <x-form wire:submit.prevent="submitForm" action="/lettering-standards">

        <x-input.group for="track_event_id" label="Event" :error="$errors->first('track_event_id')">
            <x-input.select wire:model="track_event_id">
                <option value="">Event...</option>
                @foreach($trackEvents as $trackEvent)
                    <option value="{{ $trackEvent->id }}">
                        {{ $trackEvent->name}}
                    </option>
                @endforeach
            </x-input.select>
        </x-input.group>


        <div class="py-2">
            <div class="text-red-700 font-semibold text-sm">
                Freshman Time
            </div>
            <div class="flex space-x-3">
                <x-input.group for="freshman_minutes" label="Minutes" :error="$errors->first('freshman_minutes')">
                    <x-input.text
                        wire:model.defer="freshman_minutes"
                        type="number"
                        min="0"
                    >
                    </x-input.text>
                </x-input.group>

                <x-input.group for="freshman_seconds" label="Seconds" :error="$errors->first('freshman_seconds')">
                    <x-input.text
                        leading-add-on=":"
                        wire:model.defer="freshman_seconds"
                        type="number"
                        min="0"
                        max="59"
                    >
                    </x-input.text>
                </x-input.group>
                    <x-input.group for="freshman_milliseconds" label="ms" :error="$errors->first('freshman_milliseconds')">
                        <x-input.text
                            leading-add-on="."
                            wire:model.defer="freshman_milliseconds"
                            type="number"
                            min="0"
                            max="99"
                        >
                        </x-input.text>
                </x-input.group>
            </div>
        </div>

        <div class="py-2">
            <div class="text-red-700 font-semibold text-sm">
                Sophomore Time
            </div>
            <div class="flex space-x-3">
                <x-input.group for="sophomore_minutes" label="Minutes" :error="$errors->first('sophomore_minutes')">
                    <x-input.text
                        wire:model.defer="sophomore_minutes"
                        type="number"
                        min="0"
                    >
                    </x-input.text>
                </x-input.group>

                <x-input.group for="sophomore_seconds" label="Seconds" :error="$errors->first('sophomore_seconds')">
                    <x-input.text
                        leading-add-on=":"
                        wire:model.defer="sophomore_seconds"
                        type="number"
                        min="0"
                        max="59"
                    >
                    </x-input.text>
                </x-input.group>
                    <x-input.group for="sophomore_milliseconds" label="ms" :error="$errors->first('sophomore_milliseconds')">
                        <x-input.text
                            leading-add-on="."
                            wire:model.defer="sophomore_milliseconds"
                            type="number"
                            min="0"
                            max="99"
                        >
                        </x-input.text>
                </x-input.group>
            </div>
        </div>

        <div class="py-2">
            <div class="text-red-700 font-semibold text-sm">
                Junior Time
            </div>
            <div class="flex space-x-3">
                <x-input.group for="junior_minutes" label="Minutes" :error="$errors->first('junior_minutes')">
                    <x-input.text
                        wire:model.defer="junior_minutes"
                        type="number"
                        min="0"
                    >
                    </x-input.text>
                </x-input.group>

                <x-input.group for="junior_seconds" label="Seconds" :error="$errors->first('junior_seconds')">
                    <x-input.text
                        leading-add-on=":"
                        wire:model.defer="junior_seconds"
                        type="number"
                        min="0"
                        max="59"
                    >
                    </x-input.text>
                </x-input.group>
                    <x-input.group for="junior_milliseconds" label="ms" :error="$errors->first('junior_milliseconds')">
                        <x-input.text
                            leading-add-on="."
                            wire:model.defer="junior_milliseconds"
                            type="number"
                            min="0"
                            max="99"
                        >
                        </x-input.text>
                </x-input.group>
            </div>
        </div>

        <div class="py-2">
            <div class="text-red-700 font-semibold text-sm">
                Senior Time
            </div>
            <div class="flex space-x-3">
                <x-input.group for="senior_minutes" label="Minutes" :error="$errors->first('senior_minutes')">
                    <x-input.text
                        wire:model.defer="senior_minutes"
                        type="number"
                        min="0"
                    >
                    </x-input.text>
                </x-input.group>

                <x-input.group for="senior_seconds" label="Seconds" :error="$errors->first('senior_seconds')">
                    <x-input.text
                        leading-add-on=":"
                        wire:model.defer="senior_seconds"
                        type="number"
                        min="0"
                        max="59"
                    >
                    </x-input.text>
                </x-input.group>
                    <x-input.group for="senior_milliseconds" label="ms" :error="$errors->first('senior_milliseconds')">
                        <x-input.text
                            leading-add-on="."
                            wire:model.defer="senior_milliseconds"
                            type="number"
                            min="0"
                            max="99"
                        >
                        </x-input.text>
                </x-input.group>
            </div>
        </div>

    </x-form>
</div>
