@props(['route'])

@php
    $classes = Request::routeIs($route) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white';
@endphp

<a href="{{ route($route) }}"
   {{ $attributes->merge(['class' => 'block px-3 py-2 rounded-md text-base font-medium ' . $classes]) }}>
    {{ $slot }}
</a>
