@props(['text' => 'text-gray-800'])

<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow rounded-lg']) }}>
  <div class="px-4 py-5 sm:p-6 {{ $text }}">
      {{ $slot }}
  </div>
</div>

