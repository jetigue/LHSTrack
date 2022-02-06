<div class="flex items-end justify-between w-full pt-4 md:pt-6 lg:pt-8">
    <h3 class="text-lg lg:text-2xl font-semibold font-medium text-gray-400">
        {{ $slot }}
    </h3>
    <div class="flex">
        @if (isset($action))
            <div class="">
                {{ $action }}
            </div>
        @endif
    </div>
</div>
