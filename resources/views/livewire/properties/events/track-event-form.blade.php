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
                >
            </x-input.text>
        </x-input.group>

        <x-input.group for="event_category_id" label="Categories" :error="$errors->first('event_category_id')">
           <x-input.select wire:model="event_category_id">
               <option value="">Category...</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>

    </x-form>
</div>
