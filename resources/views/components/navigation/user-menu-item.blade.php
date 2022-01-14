@props(['route'])

@php
    $classes = Request::routeIs($route) ? 'text-white' : 'text-gray-400 hover:text-gray-300 hover:underline';
@endphp

<li>
    <a href="{{ route($route) }}"
       {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
