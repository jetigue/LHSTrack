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

<body class="bg-black min-h-screen w-full">
        <main class="min-w-full">
            <div class="w-full">
                @include('layouts.navigation')
            </div>
            <div class="max-w-full">
                @if (isset($banner))
                    {{ $banner }}
                @endif
            </div>
            <div class="max-w-screen-xl mx-auto w-full px-2 md:px-4 md:px-6 text-gray-800">
                {{ $slot }}
            </div>
        </main>
@stack('modals')
@livewireScripts
@livewireCalendarScripts
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
</body>

</html>
