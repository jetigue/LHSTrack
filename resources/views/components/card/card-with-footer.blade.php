@props(['text' => 'text-gray-800'])

<div class="bg-white overflow-hidden overflow-hidden shadow rounded-lg {{ $text }}">
    <div class="px-4 py-5 sm:p-6">
        {{ $slot }}
    </div>
    <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
       {{ $footer }}
    </div>
</div>

