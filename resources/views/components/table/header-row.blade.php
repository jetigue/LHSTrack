<div class="flex w-full border-b-2 border-red-900">
    <div {{ $attributes->merge(['class' => 'flex w-full text-sm py-2']) }}>
        {{ $slot }}
    </div>
</div>
