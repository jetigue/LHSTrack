<div class="min-h-full">
    <x-form wire:submit.prevent="submitForm" action="/training/event-page/links">
        <x-input.group for="text" label="Text" :error="$errors->first('text')">
            <x-input.text
                wire:model.defer="text"
                type="text"
            ></x-input.text>
        </x-input.group>

        <x-input.group for="url" label="Url" :error="$errors->first('url')">
            <x-input.text
                wire:model.defer="url"
                type="url"
            ></x-input.text>
        </x-input.group>
    </x-form>
</div>
