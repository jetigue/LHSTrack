{{--<header class="h-24 bg-white -mx-12">--}}
{{--    <div class="flex items-center px-12 h-full">--}}
{{--        <div class="flex flex-col w-full">--}}
{{--            <div>--}}
{{--                @if (isset($breadcrumbs))--}}
{{--                    <div>--}}
{{--                        {{ $breadcrumbs }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            <div class="flex-1 min-w-0">--}}
{{--                <div class="text-2xl font-semibold md:text-3xl lg:text-4xl lg:font-normal text-gray-900 sm:truncate">--}}
{{--                    {{ $slot }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="md:hidden flex w-full">--}}
{{--                @if (isset($action))--}}
{{--                    <div class="flex w-full">--}}
{{--                        {{ $action }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="hidden md:flex flex-shrink-0">--}}
{{--            @if (isset($action))--}}
{{--                <div class="flex w-full">--}}
{{--                    {{ $action }}--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}
<div class="max-w-7xl mx-auto h-20 lg:mb-2">
    <div class="flex justify-between items-end min-h-full py-4">
        <div class="flex flex-col w-full items-baseline">
            @if (isset($breadcrumbs))
                <div>
                    {{ $breadcrumbs }}
                </div>
            @endif
            <h1 class="text-4xl font-light text-white">
                {{ $slot }}
            </h1>
        </div>
        <div class="hidden md:flex w-full justify-end">
            @if (isset($action))
                <div class="">
                    {{ $action }}
                </div>
            @endif
        </div>
    </div>
{{--    <div class="hidden md:flex">--}}
{{--        @if (isset($action))--}}
{{--            <div class="flex w-full">--}}
{{--                {{ $action }}--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}
</div>

