<div class="max-w-7xl mx-auto h-20">
    <div class="flex justify-between items-end min-h-full py-4">
        <div class="flex flex-col w-full items-baseline">
            @if (isset($breadcrumbs))
                <div>
                    {{ $breadcrumbs }}
                </div>
            @endif
            <div class="text-3xl lg:text-4xl font-light text-white">
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

