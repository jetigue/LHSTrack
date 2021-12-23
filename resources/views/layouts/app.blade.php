<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')

        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
@endif

<!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
@livewireStyles

<!-- Scripts -->
    <script src="{{ url(mix('js/app.js')) }}" defer></script>
    <script src="https://cdn.tiny.cloud/1/hksmu223g9r0m43cpt4rdqbo8dmme30uymittykfnlhft4jd/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-black min-w-full min-h-screen">
    <div class="container h-full bg-black">
        <main class="w-full">
                @auth
                <div class="flex w-full">
                    <div>
                        @include('layouts.user-sidebar-navigation')
                    </div>

                    <div class="flex flex-col w-full">
                        <div class="">
                            @include('layouts.navigation')
                        </div>
                        <div>
{{--                            @if (isset($banner))--}}
{{--                                {{ $banner }}--}}
{{--                            @endif--}}
                        </div>
                        <div class="w-full p-4 md:p-6 lg:p-8 border-double border-t-4 border-l-4 border-red-900 rounded-tl-xl">
                            {{ $slot }}
                        </div>
                    </div>
                </div>

                @endauth
                @guest
                        <div class="flex flex-col w-full">
                            <div>
                                @include('layouts.navigation')
                            </div>
                            <div>
                                @if (isset($banner))
                                    {{ $banner }}
                                @endif
                            </div>
                            <div class="max-w-screen-xl mx-auto w-full p-4 md:p-6 lg:p-8 border-t-2 border-red-900">
                                {{ $slot }}
                            </div>
                        </div>
                    @endguest

        </main>


</div>
@stack('modals')
@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
</body>

</html>
