<header {{ $attributes->merge(['class'=>'text-xl font-medium text-red-800 py-2']) }}>
    {{ $heading }}
</header>

<ul class="space-y-1.5">
    {{ $slot }}
</ul>
