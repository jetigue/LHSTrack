<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-end h-20 py-4">
        <div class="flex flex-col w-full h-full items-baseline">
            @if (isset($breadcrumbs))
                <div class="flex -mt-4">
                    {{ $breadcrumbs }}
                </div>
            @endif
            <div class="flex h-full text-2xl md:text-3xl lg:text-4xl font-light text-gray-100 items-end">
                {{ $slot }}
            </div>
        </div>
        <div class="hidden md:flex w-full justify-end">
            @if (isset($action))
                <div class="">
                    {{ $action }}
                </div>
            @endif
        </div>
    </div>
</div>

