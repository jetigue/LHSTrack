@props([
    'leadingAddOn' => false,
    'trailingDropDown' => false
])

<div class="mt-1 flex rounded-md shadow-sm">
    @if ($leadingAddOn)
        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            {{ $leadingAddOn }}
        </span>
    @endif


    <input {{ $attributes }}
           type="text"
           class="{{ $leadingAddOn ? 'rounded-none rounded-r-md' : 'rounded-md' }} flex-1 block w-full focus:ring-red-800 focus:border-red-800 min-w-0 sm:text-sm border-gray-300">

        @if ($trailingDropDown)
            {{ $trailingDropDown }}
        @endif
</div>
