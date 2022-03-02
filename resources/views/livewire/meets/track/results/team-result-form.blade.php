<div>
    <x-form wire:submit.prevent="submitForm" action="/track-meets/team-results">

        <x-input.group for="division_id" label="Division" :error="$errors->first('division_id')">
           <x-input.select wire:model="division_id">
               <option value=""></option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}">
                        {{ $division->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>

        <x-input.group for="place" label="Place" :error="$errors->first('place')">
            <x-input.text
                wire:model.defer="place"
                type="number"
                min="1"
                >
            </x-input.text>
        </x-input.group>

        <x-input.group for="points" label="Points" :error="$errors->first('points')">
            <x-input.text
                wire:model.defer="points"
                type="number"
                min="0"
                >
            </x-input.text>
        </x-input.group>

        <x-input.group for="number_teams" label="Number of Teams" :error="$errors->first('number_teams')">
            <x-input.text
                wire:model.defer="number_teams"
                type="number"
                min="1"
                >
            </x-input.text>
        </x-input.group>

        <x-input.group for="notes" label="Notes (optional)" :error="$errors->first('notes')">
            <x-input.text
                wire:model.defer="notes"
                type="text"
                >
            </x-input.text>
        </x-input.group>
    </x-form>
</div>
