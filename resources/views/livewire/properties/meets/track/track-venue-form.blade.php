<div>
    <x-form wire:submit.prevent="submitForm" action="/track/venues">

        <x-input.group for="name" label="Venue Name" :error="$errors->first('name')">
            <x-input.text
                wire:model.defer="name"
                type="text"
                >
            </x-input.text>
        </x-input.group>

        <x-input.group for="Surfaces" label="Surface" :error="$errors->first('track_surface_id')">
           <x-input.select wire:model="track_surface_id">
               <option value="">Surface...</option>
                @foreach($trackSurfaces as $trackSurface)
                    <option value="{{ $trackSurface->id }}">
                        {{ $trackSurface->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>

    </x-form>
</div>
