@props([
    'href',
    'leadingArrow' => true

])

<li>
    <div class="flex items-center">
        @if($leadingArrow)
            <x-icon.chevron-right class="text-blue-400"/>
        @endif

        <a href="{{ $href }}"
           class="{{ $leadingArrow ? 'ml-2 ' : '' }} text-sm font-medium text-gray-400 hover:text-gray-700">
            {{ $slot }}
        </a>
    </div>
</li>
