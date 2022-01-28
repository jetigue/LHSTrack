<div>
    <x-form wire:submit.prevent="submitForm" action="/properties/divisions">

        <x-input.group for="gender_id" label="Genders" :error="$errors->first('gender_id')">
           <x-input.select wire:model="gender_id">
               <option value="">Gender...</option>
                @foreach($genders as $gender)
                    <option value="{{ $gender->id }}">
                        {{ $gender->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>

        <x-input.group for="level_id" label="Levels" :error="$errors->first('level_id')">
           <x-input.select wire:model="level_id">
               <option value="">Level...</option>
                @foreach($levels as $level)
                    <option value="{{ $level->id }}">
                        {{ $level->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>
    </x-form>
</div>
