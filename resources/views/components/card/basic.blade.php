<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow rounded-lg']) }}>
  <div class="px-4 py-5 sm:p-6 text-gray-800">
      {{ $slot }}
  </div>
</div>

