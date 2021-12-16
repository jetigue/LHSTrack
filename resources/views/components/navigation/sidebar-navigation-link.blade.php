@props(['route'])

@php
    $classes = Request::routeIs($route) ? 'bg-gray-100 text-gray-800' : 'bg-white text-gray-700 hover:bg-gray-200 hover:text-gray-800';
@endphp

<a href="{{ route($route) }}"
   {{ $attributes->merge(['class' => 'w-full flex items-center pl-2 py-2 text-sm font-medium rounded-md ' . $classes]) }}>
    {{ $slot }}
</a>
