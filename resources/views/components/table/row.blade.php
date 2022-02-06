<div {{ $attributes->merge(['class' => 'text-gray-800 px-2 flex w-full text-base overflow-visible hover:bg-white rounded py-1']) }}>
    <div class="flex w-full py-1 items-center">
        {{ $slot }}
    </div>
</div>
