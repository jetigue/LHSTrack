<div>
    <x-form wire:submit.prevent="submitForm" action="/timing-methods">
        <x-input.group for="name" label="Method Name" :error="$errors->first('name')">
            <x-input.text
                wire:model.defer="name"
                type="text"
                >
            </x-input.text>
        </x-input.group>
    </x-form>
</div>
