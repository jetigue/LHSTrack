@props(['route'])

@php
    $classes = Request::routeIs($route) ? 'bg-gray-100 text-gray-700' : 'bg-white text-gray-700 hover:bg-gray-200 hover:text-gray-700';
@endphp

<a href="{{ route($route) }}"
   {{ $attributes->merge(['class' => 'group w-full flex items-center pl-11 pr-2 py-2 text-sm rounded-md ' . $classes]) }}>
    {{ $slot }}
</a>
