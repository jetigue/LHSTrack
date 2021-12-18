@props(['route'])

@php
$classes = Request::routeIs($route) ? 'bg-gray-900 text-white px-3 py-2 rounded-md font-medium' : 'text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md font-medium';
@endphp

<a href="{{ route($route) }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
