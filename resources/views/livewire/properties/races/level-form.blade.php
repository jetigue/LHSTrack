<div>
    <x-form wire:submit.prevent="submitForm" action="/properties/levels">
        <x-input.group for="name" label="Level Name" :error="$errors->first('name')">
            <x-input.text
                wire:model.defer="name"
                type="text"
                >
            </x-input.text>
        </x-input.group>
    </x-form>
</div>
