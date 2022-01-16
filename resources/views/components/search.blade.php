<div x-data="{show : false}" class="flex w-full flex-col space-y-1 items-end">
    <button type="button" wire:click="clearSearch" class="hidden md:flex text-xs text-gray-300 hover:text-gray-200">
        Clear Search
    </button>
    <x-input.text wire:model="search" class="hidden md:flex py-2 rounded shadow" placeholder="Search..."/>
    <x-icon.search
        x-show="!show"
        @mousedown="show=true"
        wire:model="search"
        class="flex md:hidden text-gray-400 mr-2 mb-2" />
    <div
        x-show="show"
        class="absolute w-full bg-black top-20 right-2">
        <div class="flex items-center justify-between px-4">
            <div class="flex flex-col items-end">
                <button
                    type="button"
                    x-on:click="$wire.clearSearch"
                    class="text-xs text-gray-300 hover:text-gray-200">
                    Clear
                </button>
                <x-input.text
                    wire:model="search"
                    class="flex py-2 rounded shadow"
                    placeholder="Search {{ $this->route }}" />
            </div>

            <button
                type="button"
                class="flex flex-col h-full content-center pt-6 text-gray-500 text-xs"
                x-on:click="show=false">
                <x-icon.eye-off />
                Hide
            </button>
        </div>

    </div>

</div>
