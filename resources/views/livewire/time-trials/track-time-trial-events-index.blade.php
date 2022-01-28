<div class="flex w-full justify-around py-4 space-x-8">
    <div class="flex w-full md:w-1/2">
        <x-card.card-with-header color="black">
            <x-slot name="header">
                <div class="text-gray-100">
                    Boys Events
                </div>

            </x-slot>
            <ol class="space-y-2">
                @foreach($timeTrial->boysTrackEvents as $event)
                    <li class="text-gray-100">{{$event->name}}</li>
                @endforeach
            </ol>

        </x-card.card-with-header>
    </div>
<div class="flex w-full md:w-1/2">
        <x-card.card-with-header color="black">
            <x-slot name="header">
                <div class="text-gray-100">
                    Girls Events
                </div>
            </x-slot>
            <ol class="space-y-2">
                @foreach($timeTrial->girlsTrackEvents as $event)
                    <li class="text-gray-100">{{$event->name}}</li>
                @endforeach
            </ol>

        </x-card.card-with-header>
</div>
    </div>
</div>
