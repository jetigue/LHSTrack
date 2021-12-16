<button
    x-data="{show: false}"
    type="button"
    wire:click="showFormModal"
    @mouseover="show=true"
    @mouseleave="show=false"
    class="relative text-red-800 text-lg"

><i class="fas fa-plus"></i>
    <div x-show="show" class="relative z-50 bottom-11 text-xs font-semibold -mx-2">Add</div>
</button>
