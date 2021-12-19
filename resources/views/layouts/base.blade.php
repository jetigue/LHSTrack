<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-black">
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
    <script src="https://cdn.tiny.cloud/1/hksmu223g9r0m43cpt4rdqbo8dmme30uymittykfnlhft4jd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="">
<div class="container mx-auto h-full">
    <div class="bg-black">
        @include('layouts.navigation')
        @if (isset($banner))
            {{ $banner }}
        @endif
    </div>
    <main class="max-w-7xl w-full mx-auto pb-2 px-4 sm:px-6 lg:px-8">
{{--        <div class="">--}}
            <div class="rounded-md md:px-0 sm:px-6">
                <div class="rounded-lg">
                    {{ $slot }}
                </div>
            </div>
{{--        </div>--}}
    </main>
</div>
{{--</div>--}}

@stack('modals')
@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
</body>

</html>
