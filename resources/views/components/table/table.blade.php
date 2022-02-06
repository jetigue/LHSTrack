@props(['color' => 'gray-50'])

<div {{ $attributes->merge(['class' => 'flex flex-col w-full p-2 md:p-4 lg:p-6 rounded-lg shadow bg-'.$color]) }}>
    <div>
        {{ $head }}
    </div>

    <div class="flex flex-col w-full divide-y divide-gray-200">
        {{ $body }}
    </div>
</div>
