@props([
    'href',
])

<nav class="md:hidden" aria-label="Back">
    <a href="{{ $href }}" class="flex items-center text-sm font-medium text-blue-400 hover:text-blue-800">
        <x-icon.chevron-left class="text-blue-400"/>
        Back
    </a>
</nav>
