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

        <x-input.group for="sex" label="Sex" :error="$errors->first('sex')">
            <x-input.select
                wire:model.defer="sex">
                    <option value=""></option>
                    <option value="f">Female</option>
                    <option value="m">Male</option>
            </x-input.select>
        </x-input.group>

        <x-input.group for="grad_year" label="Graduation Year" :error="$errors->first('grad_year')">
            <x-input.select
                wire:model.defer="grad_year">
                <option value=""></option>
                    @for ($i = 2010; $i <= 2030; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
            </x-input.select>
        </x-input.group>

        <x-input.group for="dob_for_editing" label="Birthdate" :error="$errors->first('dob_for_editing')">
            <x-input.date
                wire:model.defer="dob_for_editing"
                >
            </x-input.date>
        </x-input.group>

        <x-input.group for="status" label="Status" :error="$errors->first('status')">
            <x-input.select
                wire:model.defer="status">
                    <option value=""></option>
                    <option value="a">Active</option>
                    <option value="i">Inactive</option>
            </x-input.select>
        </x-input.group>

    </x-form>
</div>
