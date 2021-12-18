<div class="min-h-full">
    <x-form wire:submit.prevent="submitForm" action="/event">
        <x-input.group for="title" label="Title" :error="$errors->first('title')">
            <x-input.text
                wire:model.defer="title"
                type="text"
            ></x-input.text>
        </x-input.group>

        <x-input.group for="event_date_for_editing" label="Event Date" :error="$errors->first('event_date_for_editing')">
            <x-input.date
                wire:model="event_date_for_editing"
                placeholder="MM/DD/YYYY"
            ></x-input.date>
        </x-input.group>

        <x-input.group for="description" label="Description" :error="$errors->first('body')">
            <x-input.tinymce wire:model="description" placeholder="Type anything you want..." />
        </x-input.group>
    </x-form>
</div>
