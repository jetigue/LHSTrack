<li
    wire:click="showCreateModal"
    class="col-span-1 bg-white rounded-lg shadow border-2 border-white cursor-pointer hover:border-indigo-500 opacity-50 hover:opacity-100">
    <div class="flex h-full items-center text-indigo-500 space-x-6 px-6">
        <x-icon.plus class="w-16 h-16"/>
        <div class="text-2xl cursor-pointer">{{ $slot }}</div>
    </div>
</li>
