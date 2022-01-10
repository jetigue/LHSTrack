<div>
    <x-form wire:submit.prevent="submitForm" action="/track-meets">

        <x-input.group for="meet_date_for_editing" label="Meet Date" :error="$errors->first('meet_date_for_editing')">
            <x-input.date
                wire:model.defer="meet_date_for_editing"
                >
            </x-input.date>
        </x-input.group>

        <x-input.group for="trackMeetName" label="Meet Name" :error="$errors->first('track_meet_name_id')">
           <x-input.select wire:model="track_meet_name_id">
               <option value="">Meet name...</option>
                @foreach($trackMeetNames as $trackMeetName)
                    <option value="{{ $trackMeetName->id }}">
                        {{ $trackMeetName->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>

        <x-input.group for="host" label="Meet Host" :error="$errors->first('host_id')">
           <x-input.select wire:model="host_id">
               <option value="">Host name...</option>
                @foreach($hosts as $host)
                    <option value="{{ $host->id }}">
                        {{ $host->name }}
                    </option>
                @endforeach
           </x-input.select>
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

        <x-input.group for="season" label="Season" :error="$errors->first('track_season_id')">
           <x-input.select wire:model="track_season_id">
               <option value="">Season...</option>
                @foreach($trackSeasons as $trackSeason)
                    <option value="{{ $trackSeason->id }}">
                        {{ $trackSeason->name }}
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

        <x-input.group for="meet_page_url" label="Meet Page URL" :error="$errors->first('meet_page_url')">
            <x-input.text
                wire:model.defer="meet_page_url"
                type="text"
                >
            </x-input.text>
        </x-input.group>


    </x-form>
</div>
