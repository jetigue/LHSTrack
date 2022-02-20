<div class="min-h-full">
    <x-form wire:submit.prevent="submitForm" action="/training/event-page/announcements">
        <x-input.group for="title" label="Title" :error="$errors->first('title')">
            <x-input.text
                wire:model.defer="title"
                type="text"
            ></x-input.text>
        </x-input.group>

        <x-input.group for="begin_date_for_editing" label="Begin Date" :error="$errors->first('begin_date_for_editing')">
            <x-input.date
                wire:model="begin_date_for_editing"
                placeholder="MM/DD/YYYY"
            ></x-input.date>
        </x-input.group>

        <x-input.group for="end_date_for_editing" label="End Date" :error="$errors->first('end_date_for_editing')">
            <x-input.date
                wire:model="end_date_for_editing"
                placeholder="MM/DD/YYYY"
            >
            </x-input.date>
        </x-input.group>
        <x-input.group for="body" label="Body" :error="$errors->first('body')">
            <x-input.tinymce wire:model="body" placeholder="Type anything you want..." />
        </x-input.group>
    </x-form>
</div>
