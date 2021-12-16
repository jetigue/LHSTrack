<div {{ $attributes->merge(['class' => 'pl-2 flex w-full text-sm overflow-visible hover:bg-white rounded py-2']) }}>
    <div class="flex w-full py-1 items-center">
        {{ $slot }}
    </div>
</div>
