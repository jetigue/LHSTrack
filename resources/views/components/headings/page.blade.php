<div class="mb-4 md:mb-6 lg:mb-8">
    <div class="flex max-w-7xl mx-auto">
        <div class="flex w-full items-end h-20 py-2 justify-between">
            <div class="flex flex-col h-full items-baseline content-end">
                @if (isset($breadcrumbs))
                    <div class="">
                        {{ $breadcrumbs }}
                    </div>

                    <div class="flex text-2xl md:text-3xl lg:text-4xl font-light text-gray-100 items-end">
                        {{ $slot }}
                    </div>
                @else
                <div class="flex text-2xl md:text-3xl lg:text-4xl font-light text-gray-100 pt-6">
                    {{ $slot }}
                </div>
                @endif
            </div>
            <div class="flex items-end ml-2">
                @if (isset($action))
                    <div class="flex">
                        {{ $action }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="gradient-line"></div>
</div>


