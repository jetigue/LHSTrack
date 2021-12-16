@props(['title', 'iconBackground', 'href'])

<div {{ $attributes->merge(['class' => 'relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500']) }}>
    <div>
        <span
            style="background-color: {{ $iconBackground }}"
            class="rounded-lg inline-flex p-3 ring-4 ring-white">
          {{ $icon }}
        </span>
    </div>
    <div class="mt-8">
        <h3 class="text-lg font-medium">
            <a href="{{ $href }}" class="focus:outline-none">
                <!-- Extend touch target to entire panel -->
                <span class="absolute inset-0" aria-hidden="true"></span>
                {{ $title }}
            </a>
        </h3>
        <p class="mt-2 text-sm text-gray-500">
            {{ $content}}
        </p>
    </div>
    <span class="pointer-events-none absolute top-6 right-6 text-gray-300 group-hover:text-gray-400" aria-hidden="true">
        <x-icon.arrow-up-right/>
    </span>
</div>
