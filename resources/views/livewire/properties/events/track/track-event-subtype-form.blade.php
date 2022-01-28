<div>
    <x-form wire:submit.prevent="submitForm" action="/track/event-subtypes">

        <x-input.group for="name" label="Subtype Name" :error="$errors->first('name')">
            <x-input.text
                wire:model.defer="name"
                type="text"
                >
            </x-input.text>
        </x-input.group>

        <x-input.group for="track_event_type_id" label="Categories" :error="$errors->first('track_event_type_id')">
           <x-input.select wire:model="track_event_type_id">
               <option value="">Event type...</option>
                @foreach($eventTypes as $eventType)
                    <option value="{{ $eventType->id }}">
                        {{ $eventType->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>

    </x-form>
</div>
