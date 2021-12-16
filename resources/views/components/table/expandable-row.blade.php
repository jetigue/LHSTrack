<div x-data="{ open: false }" {{ $attributes->merge(['class' => ' py-2 flex flex-col w-full text-sm overflow-visible hover:bg-white rounded pl-2']) }}>
    <div class="relative w-full">
        <div class="flex w-full pt-2 pb-1 items-center">
            {{ $unexpandedContent  }}
        </div>
        <div class="absolute lg:hidden z-20 top-2 right-0 pr-2">
            <button @click="open = !open" type="button"
                    class="text-gray-200 hover:text-gray-100 group w-full flex items-center text-sm font-medium rounded-md justify-end"
                    aria-controls="sub-menu-1" aria-expanded="false">
                <svg x-show="!open"
                     class="text-gray-300 h-6 w-6 transform group-hover:text-gray-500 transition-colors ease-in-out duration-250"
                     viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M6 6L14 10L6 14V6Z" fill="currentColor"/>
                </svg>
                <svg x-show="open"
                     class="text-gray-500 h-6 w-6 transform rotate-90 group-hover:text-gray-400 transition-colors ease-in-out duration-250"
                     viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M6 6L14 10L6 14V6Z" fill="currentColor"/>
                </svg>
            </button>
        </div>
    </div>
    <div x-show="open" class="space-y-1 group-bg-gray-200 pb-1" id="sub-menu-1"
         x-transition:enter="transition ease-out duration-250"
         x-transition:enter-start="transform opacity-0 scale-90"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95">
        <div class="flex flex-col w-full">
            {{ $expandedContent }}
        </div>
    </div>
</div>
