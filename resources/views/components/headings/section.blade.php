<div class="flex items-end justify-between w-full">
    <h3 class="text-lg leading-6 font-medium text-red-700">
        {{ $slot }}
    </h3>
    <div class="flex mt-0 ">
        @if (isset($action))
            <div class="">
                {{ $action }}
            </div>
        @endif
    </div>
</div>
