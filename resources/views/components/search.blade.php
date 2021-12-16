<div class="flex flex-col space-y-1 items-end">
    <button type="button" wire:click="clearSearch" class="text-xs text-gray-300 hover:text-gray-200">
        Clear Search
    </button>
    <x-input.text wire:model="search" class="flex py-2 rounded shadow" placeholder="Search..."/>
</div>
