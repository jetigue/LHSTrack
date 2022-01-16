<div class="max-w-7xl mx-auto">
    <div class="flex w-full items-end h-20 py-2 md:py-4">
        <div class="flex flex-col w-full md:w-5/6 h-full items-baseline">
            @if (isset($breadcrumbs))
                <div class="flex">
                    {{ $breadcrumbs }}
                </div>
            @endif
            <div class="flex h-full text-2xl md:text-3xl lg:text-4xl font-light text-gray-100 items-end">
                {{ $slot }}
            </div>
        </div>
        <div class="flex md:w-1/6 justify-end ml-2">
            @if (isset($action))
                <div class="">
                    {{ $action }}
                </div>
            @endif
        </div>
    </div>
</div>

