<x-input.group for="event" label="Event">
    <x-input.select wire:model="event">
        <option value=''></option>
        @foreach($runningEvents as $runningEvent)
            <option value="{{ $runningEvent->id }}">{{$runningEvent->name}}</option>
        @endforeach
        @foreach($fieldEvents as $fieldEvent)
            <option value="{{ $fieldEvent->id }}">{{$fieldEvent->name}}</option>
        @endforeach
    </x-input.select>
</x-input.group>
