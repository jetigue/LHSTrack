<div>
    <x-form wire:submit.prevent="submitForm" action="/track-time-trials">

        <x-input.group for="name" label="Trial Name" :error="$errors->first('name')">
            <x-input.text
                wire:model.defer="name"
                type="text"
                >
            </x-input.text>
        </x-input.group>

        <x-input.group for="trial_date_for_editing" label="Trial Date" :error="$errors->first('trial_date_for_editing')">
            <x-input.date
                wire:model.defer="trial_date_for_editing"
                >
            </x-input.date>
        </x-input.group>

        <x-input.group for="venue" label="Venue" :error="$errors->first('track_venue_id')">
           <x-input.select wire:model="track_venue_id">
               <option value="">Venue...</option>
                @foreach($trackVenues as $trackVenue)
                    <option value="{{ $trackVenue->id }}">
                        {{ $trackVenue->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>

        <x-input.group for="TimingMethods" label="Timing Method" :error="$errors->first('timing_method_id')">
           <x-input.select wire:model="timing_method_id">
               <option value="">Method...</option>
                @foreach($timingMethods as $timingMethod)
                    <option value="{{ $timingMethod->id }}">
                        {{ $timingMethod->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>
</x-form>
</div>
