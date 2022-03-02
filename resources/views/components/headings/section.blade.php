<div class="flex items-end justify-between w-full py-4">
    <h3 class="text-lg lg:text-xl font-semibold text-gray-200">
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
