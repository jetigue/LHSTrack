<div class="py-2">
    <x-breadcrumb.menu>
        <x-breadcrumb.item href="{{ route('Track Time Trials') }}" :leadingArrow=" false ">
            Time Trials
        </x-breadcrumb.item>
    </x-breadcrumb.menu>

    <div class="flex h-full text-2xl md:text-3xl lg:text-4xl font-light text-gray-100 items-end">
        {{ $timeTrial->name }}
    </div>
</div>

<div class="flex flex-col w-full">
    <div class="flex flex-col">
        <div class="px-4 text-gray-100 border-t-2 border-b-2 border-red-700">
            <div class="flex flex-wrap justify-between py-1">
                <div class="flex w-full md:w-1/3 text-sm md:justify-start">
                    {{date('F j, Y', strtotime( $timeTrial->trial_date))}}
                </div>
                <div class="flex w-full md:w-1/3 text-sm md:justify-center">
                    {{ $timeTrial->venue->name }}
                </div>
                <div class="flex w-full md:w-1/3 text-sm md:justify-end">
                    {{ $timeTrial->timingMethod->name }} Timing
                </div>
            </div>
        </div>
    </div>
</div>
