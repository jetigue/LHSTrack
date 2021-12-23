@props(['route'])

@php
    $classes = Request::routeIs($route) ? 'bg-red-800 text-gray-100' : 'bg-gray-600 text-gray-200 hover:bg-red-800 hover:text-gray-200';
@endphp

<a href="{{ route($route) }}"
   {{ $attributes->merge(['class' => 'w-full flex items-center pl-2 py-2 text-sm font-medium rounded-md ' . $classes]) }}>
    {{ $slot }}
</a>
