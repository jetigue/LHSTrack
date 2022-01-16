<div class="flex flex-col space-y-1 items-end">
    <button type="button" wire:click="clearSearch" class="hidden md:flex text-xs text-gray-300 hover:text-gray-200">
        Clear Search
    </button>
    <x-input.text wire:model="search" class="hidden md:flex py-2 rounded shadow" placeholder="Search..."/>
    <x-icon.search wire:model="search" class="flex md:hidden text-gray-400" />
</div>
