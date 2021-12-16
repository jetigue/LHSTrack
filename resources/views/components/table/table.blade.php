<div {{ $attributes->merge(['class' => 'flex flex-col w-full p-6 rounded-lg shadow bg-gray-50']) }}>
    <div>
        {{ $head }}
    </div>

    <div class="flex flex-col w-full divide-y divide-gray-200">
        {{ $body }}
    </div>
</div>
