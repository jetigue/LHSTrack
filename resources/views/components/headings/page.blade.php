<div class="max-w-7xl mx-auto mb-6 lg:mb-8">
    <div class="flex w-full items-baseline h-20 py-2 justify-between">
        <div class="flex flex-col h-full items-baseline content-end">
            @if (isset($breadcrumbs))
                <div class="flex">
                    {{ $breadcrumbs }}
                </div>
            @endif
            <div class="flex h-full text-2xl md:text-3xl lg:text-4xl font-light text-gray-100 items-end content-end">
                {{ $slot }}
            </div>
        </div>
        <div class="flex justify-end ml-2">
            @if (isset($action))
                <div class="">
                    {{ $action }}
                </div>
            @endif
        </div>
    </div>
    <div class="gradient-line"></div>
</div>

