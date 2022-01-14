@props(['title'])
<div class="flex flex-col justify-start">
    <header {{ $attributes->merge(['class'=>'text-xl font-medium text-red-700']) }}>
        {{ $title }}
    </header>

    <ul class="text-gray-400 px-4 space-y-1.5">
        {{ $slot }}
    </ul>
</div>

