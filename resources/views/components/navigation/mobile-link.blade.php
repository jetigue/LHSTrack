@props(['route'])

@php
    $classes = Request::routeIs($route) ? 'bg-gray-800 text-white' : 'text-gray-100 hover:bg-gray-800 hover:text-white';
@endphp

<a href="{{ route($route) }}"
   {{ $attributes->merge(['class' => 'text-gray-100 hover:bg-gray-800 hover:text-white block px-3 py-2 rounded-md text-base font-medium ' . $classes]) }}>
    {{ $slot }}
</a>
