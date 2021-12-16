@props(['active' => false])

@php
    $defaultClasses = 'block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:g-blue-500 hover:text-white focus:text-white';
    $activeClasses = 'bg-blue-500 text-white';
@endphp

<a {{ $attributes->classes([$defaultClasses, $activeClasses => $active]) }}>{{ $slot }}</a>
