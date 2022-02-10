<div>
    <x-form wire:submit.prevent="submitForm" action="/lettering-standards/field-events">

        <x-input.group for="track_event_id" label="Event" :error="$errors->first('track_event_id')">
            <x-input.select wire:model="track_event_id">
                <option value="">Event...</option>
                @foreach($fieldEvents as $fieldEvent)
                    <option value="{{ $fieldEvent->id }}">
                        {{ $fieldEvent->name }}
                    </option>
                @endforeach
            </x-input.select>
        </x-input.group>

        <div class="py-2">
            <div class="text-red-700 font-semibold text-sm">
                Freshman Mark
            </div>
            <div class="flex space-x-3">
                <x-input.group for="freshman_feet" label="Feet" :error="$errors->first('freshman_feet')">
                    <x-input.text
                        wire:model.defer="freshman_feet"
                        type="number"
                        min="1"
                    >
                    </x-input.text>
                </x-input.group>

                <x-input.group for="freshman_inches" label="Inches" :error="$errors->first('freshman_inches')">
                    <x-input.text
                        wire:model.defer="freshman_inches"
                        type="number"
                        min="0"
                        max="11"
                    >
                    </x-input.text>
                </x-input.group>

                <x-input.group for="freshman_quarter_inch" label="Fraction" :error="$errors->first('freshman_quarter_inch')">
                   <x-input.select wire:model="freshman_quarter_inch">
                       <option value="0">0</option>
                       <option value="1">.25</option>
                       <option value="2">.50</option>
                       <option value="3">.75</option>
                   </x-input.select>
                </x-input.group>
            </div>
        </div>

        <div class="py-2">
            <div class="text-red-700 font-semibold text-sm">
                Sophomore Mark
            </div>
            <div class="flex space-x-3">
                <x-input.group for="sophomore_feet" label="Feet" :error="$errors->first('sophomore_feet')">
                    <x-input.text
                        wire:model.defer="sophomore_feet"
                        type="number"
                        min="1"
                    >
                    </x-input.text>
                </x-input.group>

                <x-input.group for="sophomore_inches" label="Inches" :error="$errors->first('sophomore_inches')">
                    <x-input.text
                        wire:model.defer="sophomore_inches"
                        type="number"
                        min="0"
                        max="11"
                    >
                    </x-input.text>
                </x-input.group>

                <x-input.group for="sophomore_quarter_inch" label="Fraction" :error="$errors->first('sophomore_quarter_inch')">
                   <x-input.select wire:model="sophomore_quarter_inch">
                       <option value="0">0</option>
                       <option value="1">.25</option>
                       <option value="2">.50</option>
                       <option value="3">.75</option>
                   </x-input.select>
                </x-input.group>
            </div>
        </div>

        <div class="py-2">
            <div class="text-red-700 font-semibold text-sm">
                Junior Mark
            </div>
            <div class="flex space-x-3">
                <x-input.group for="junior_feet" label="Feet" :error="$errors->first('junior_feet')">
                    <x-input.text
                        wire:model.defer="junior_feet"
                        type="number"
                        min="1"
                    >
                    </x-input.text>
                </x-input.group>

                <x-input.group for="junior_inches" label="Inches" :error="$errors->first('junior_inches')">
                    <x-input.text
                        wire:model.defer="junior_inches"
                        type="number"
                        min="0"
                        max="11"
                    >
                    </x-input.text>
                </x-input.group>

                <x-input.group for="junior_quarter_inch" label="Fraction" :error="$errors->first('junior_quarter_inch')">
                   <x-input.select wire:model="junior_quarter_inch">
                       <option value="0">0</option>
                       <option value="1">.25</option>
                       <option value="2">.50</option>
                       <option value="3">.75</option>
                   </x-input.select>
                </x-input.group>
            </div>
        </div>

        <div class="py-2">
            <div class="text-red-700 font-semibold text-sm">
                Senior Mark
            </div>
            <div class="flex space-x-3">
                <x-input.group for="senior_feet" label="Feet" :error="$errors->first('senior_feet')">
                    <x-input.text
                        wire:model.defer="senior_feet"
                        type="number"
                        min="1"
                    >
                    </x-input.text>
                </x-input.group>

                <x-input.group for="senior_inches" label="Inches" :error="$errors->first('senior_inches')">
                    <x-input.text
                        wire:model.defer="senior_inches"
                        type="number"
                        min="0"
                        max="11"
                    >
                    </x-input.text>
                </x-input.group>

                <x-input.group for="senior_quarter_inch" label="Fraction" :error="$errors->first('senior_quarter_inch')">
                   <x-input.select wire:model="senior_quarter_inch">
                       <option value="0">0</option>
                       <option value="1">.25</option>
                       <option value="2">.50</option>
                       <option value="3">.75</option>
                   </x-input.select>
                </x-input.group>
            </div>
        </div>

    </x-form>
</div>
