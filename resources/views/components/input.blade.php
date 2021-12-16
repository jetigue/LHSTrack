@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-red-800 focus:ring ring:red focus:ring-red-800 focus:ring-opacity-50']) !!}>
