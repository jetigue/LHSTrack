
<div
        x-data="{ value: @entangle($attributes->wire('model')) }"
        x-init="new Pikaday({
            field: $refs.input,
            format: 'MM/DD/YYYY',
                toString(date, format) {
                const month = date.getMonth() + 1;
                const day = date.getDate();
                const year = date.getFullYear();
                return `${month}/${day}/${year}`;
            }
        })"
        x-on:change="value = $event.target.value"
        class="mt-1 relative rounded-md shadow-sm"
>
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
            <x-icon.calendar></x-icon.calendar>
        </div>
    <input
        {{ $attributes->whereDoesntStartWith('wire:model') }}
        x-ref="input"
        x-bind:value="value"
        class="rounded-md form-input flex-1 block w-full pl-10 py-2 sm:text-sm sm:leading-5"
        type="text"
    >
</div>
