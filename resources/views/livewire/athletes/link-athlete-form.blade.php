<div class="">
    <x-form wire:submit.prevent="submitForm" action="/athletes">
        <x-input.group for="first_name" label="First Name" :error="$errors->first('first_name')">
            <x-input.text
                wire:model.defer="first_name"
                type="text"
                >
            </x-input.text>
        </x-input.group>

        <x-input.group for="last_name" label="Last Name" :error="$errors->first('last_name')">
            <x-input.text
                wire:model.defer="last_name"
                type="text"
                >
            </x-input.text>
        </x-input.group>

        <x-input.group for="user_id" label="Link to User" :error="$errors->first('user_id')">
           <x-input.select wire:model="user_id">
               <option value="">User...</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>

    </x-form>
</div>
