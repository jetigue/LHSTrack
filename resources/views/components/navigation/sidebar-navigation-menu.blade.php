@props(['title'])

<div x-data="{ open: false }" class="space-y-1">
    <!-- Current: "bg-gray-100 text-gray-900", Default: "bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900" -->
    <button @click="open = !open" type="button"
            class="text-gray-200 hover:bg-gray-500 hover:text-gray-200 group w-full flex items-center pl-2 pr-1 py-2 text-left text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-red-800"
            aria-controls="sub-menu-1" aria-expanded="false">
        <!-- Heroicon name: outline/users -->
        <svg class="mr-3 flex-shrink-0 h-6 w-6 text-gray-200 group-hover:text-white-200"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
             aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <span class="flex-1">
            {{ $title }}
        </span>
        <svg x-show="!open"
            class="text-gray-500 ml-3 flex-shrink-0 h-5 w-5 transform group-hover:text-gray-700 transition-colors ease-in-out duration-150"
            viewBox="0 0 20 20" aria-hidden="true">
            <path d="M6 6L14 10L6 14V6Z" fill="currentColor"/>
        </svg>
        <svg x-show="open"
            class="text-gray-500 ml-3 flex-shrink-0 h-5 w-5 transform rotate-90 group-hover:text-gray-500 transition-colors ease-in-out duration-150"
            viewBox="0 0 20 20" aria-hidden="true">
            <path d="M6 6L14 10L6 14V6Z" fill="currentColor"/>
        </svg>
    </button>
    <!-- Expandable link section, show/hide based on state. -->
    <div x-show="open" class="space-y-1 rounded-b-md pb-1" id="sub-menu-1"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95">
        {{ $slot }}
    </div>
</div>

