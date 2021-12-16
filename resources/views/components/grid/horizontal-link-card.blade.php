@props(['iconBackground', 'href'])
<div
    {{ $attributes->merge(['class' => 'relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-red-900 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-900']) }}>
    <div class="flex-shrink-0">
            <span
                style="background-color: {{ $iconBackground }}"
                class="rounded-lg inline-flex p-3 ring-4 ring-white">
              {{ $icon }}
            </span>
    </div>
    <div class="flex-1 min-w-0">
        <a href="{{ $href }}" class="focus:outline-none">
            <span class="absolute inset-0" aria-hidden="true"></span>
            <p class="text-sm font-medium text-gray-900">
                {{ $title }}
            </p>
            <p class="text-sm text-gray-500 truncate">
                {{ $description }}
            </p>
        </a>
    </div>
</div>
