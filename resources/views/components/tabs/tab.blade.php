@props(['name'])

<div x-data="{
        id: '',
        name: '{{ $name }}',
    }"
     x-show="name === activeTab"
     role="tabpanel"
     :aria-labelledby="`tab-${id}`"
     :id="`tab-panel-${id}`"
     x-init="$dispatch('register-tab',  { name: name })"
>
    {{ $slot }}

</div>
