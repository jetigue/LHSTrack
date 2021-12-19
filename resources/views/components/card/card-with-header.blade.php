{{--@props(['color'])--}}

<div {{ $attributes->merge(['class' => 'bg-white shadow rounded-lg w-full']) }}>
    <div class="border-b border-gray-300 px-4 pt-4 pb-3 sm:px-6 text-lg font-semibold text-gray-500">
        {{ $header }}
    </div>
    <div class="px-4 py-5 sm:p-6">
        {{ $slot }}
    </div>
</div>

