<div>
    <button
        x-show="!expanded"
        @click="expanded = true"
        {{ $attributes->merge(['class' => '']) }}
        type="button"

    >
        <x-icon.chevron-right></x-icon.chevron-right>
    </button>
    <button x-show="expanded" @click="expanded = false" type="button">
        <x-icon.chevron-down ></x-icon.chevron-down>
    </button>
</div>
