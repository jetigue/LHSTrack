@props(['route'])

@php
    $classes = Request::routeIs($route) ? 'bg-red-900 text-gray-200' : 'text-gray-200 hover:bg-gray-500 hover:text-gray-200';
@endphp

<a href="{{ route($route) }}"
   {{ $attributes->merge(['class' => 'group w-full flex items-center pl-11 pr-2 py-2 text-sm rounded-md ' . $classes]) }}>
    {{ $slot }}
</a>
