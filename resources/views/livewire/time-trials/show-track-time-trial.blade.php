<div>
    <x-headings.page>
        <x-slot name="breadcrumbs">
            <x-breadcrumb.menu>
                <x-breadcrumb.item href="{{ route('Track Time Trials') }}" :leadingArrow=" false ">
                    Time Trials
                </x-breadcrumb.item>
            </x-breadcrumb.menu>
        </x-slot>
        {{ $timeTrial->name }}
    </x-headings.page>

    <div class="flex flex-col w-full">
        <div class="flex flex-col md:mt-4 md:m-0">
            <div class="px-4 py-2 border-b border-t border-gray-400 text-gray-200">
                <div class="flex flex-wrap justify-between py-1">
                    <div class="flex w-full md:w-1/3 text-sm md:text-lg md:justify-start">
                        {{date('F j, Y', strtotime( $timeTrial->trial_date))}}
                    </div>
                    <div class="flex w-full md:w-1/3 text-sm md:text-lg md:justify-center">
                        {{ $timeTrial->venue->name }}
                    </div>
                    <div class="flex w-full md:w-1/3 text-sm md:text-lg md:justify-end">
                        {{ $timeTrial->timingMethod->name }} Timing
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col py-4">
        <x-headings.section>
                Events
            <x-slot name="action">
                <x-button.primary class="py-1">
                    @if ( count($timeTrial->trackEvents) > 0 )
                        Edit Events
                    @else
                        <x-icon.plus /> Add Events
                    @endif
                </x-button.primary>
            </x-slot>
        </x-headings.section>
        <ol class="text-gray-300">
            @foreach ($timeTrial->trackEvents as $event)
                <li>{{ $event->name }}</li>
            @endforeach
        </ol>



    </div>
{{--    <livewire:time-trials.track-time-trial-events-form :timeTrial="$timeTrial"/>--}}
</div>
