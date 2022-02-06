@props([
    'sortable' => null,
    'direction' => null,
])

<div
    {{ $attributes->merge(['class' => ''])->only('class') }}
>
    @unless ($sortable)
        <span class="text-left leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ $slot }}</span>
    @else
        <button {{ $attributes->except('class') }} class="flex items-center space-x-1 text-left text-sm leading-4 font-medium text-blue-700 uppercase tracking-wider group focus:outline-none focus:underline">
            <span>{{ $slot }}</span>

            <span>
                @if ($direction === 'asc')
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                @elseif ($direction === 'desc')
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                @else
                    <svg class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                @endif
            </span>
        </button>
    @endif
</div>
