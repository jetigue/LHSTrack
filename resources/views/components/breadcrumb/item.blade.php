@props([
    'href',
    'leadingArrow' => true

])

<li>
    <div class="flex items-center">
        @if($leadingArrow)
            <x-icon.chevron-right class="text-red-900"/>
        @endif

        <a href="{{ $href }}"
           class="{{ $leadingArrow ? 'ml-2 ' : '' }} text-xs font-medium text-gray-400 hover:text-gray-300">
            {{ $slot }}
        </a>
    </div>
</li>
