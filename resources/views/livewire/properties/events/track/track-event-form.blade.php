<div>
    <x-form wire:submit.prevent="submitForm" action="/track/events">

        <x-input.group for="name" label="Event Name" :error="$errors->first('name')">
            <x-input.text
                wire:model.defer="name"
                type="text"
                >
            </x-input.text>
        </x-input.group>

        <x-input.group for="distance_in_meters" label="Distance In Meters" :error="$errors->first('distance_in_meters')">
            <x-input.text
                wire:model.defer="distance_in_meters"
                type="number"
                min="0"
                >
            </x-input.text>
        </x-input.group>

        <x-input.group for="track_event_subtype_id" label="Categories" :error="$errors->first('track_event_subtype_id')">
           <x-input.select wire:model="track_event_subtype_id">
               <option value="">Event Type...</option>
                @foreach($trackSubTypes as $trackSubType)
                    <option value="{{ $trackSubType->id }}">
                        {{ $trackSubType->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>

        <x-input.group for="boys_event" label="Boys Event?" :error="$errors->first('boys_event')">
            <x-input.select
                wire:model.defer="boys_event">
                    <option value=""></option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
            </x-input.select>
        </x-input.group>

        <x-input.group for="girls_event" label="Girls Event?" :error="$errors->first('girls_event')">
            <x-input.select
                wire:model.defer="girls_event">
                    <option value=""></option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
            </x-input.select>
        </x-input.group>

        <x-input.group for="ghsa_event" label="GHSA Event" :error="$errors->first('ghsa_event')">
            <x-input.select
                wire:model.defer="ghsa_event">
                    <option value=""></option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
            </x-input.select>
        </x-input.group>

    </x-form>
</div>
