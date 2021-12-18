<div class="w-full">
    <x-headings.page class="">
        Our Team
        <x-slot name="action">
            <div class="flex space-x-3">
            <x-button.tertiary>Boys' Roster</x-button.tertiary>
            <x-button.tertiary>Girls' Roster</x-button.tertiary>
            <x-button.tertiary>Coaches</x-button.tertiary>
            </div>
        </x-slot>
    </x-headings.page>

    <x-card.card-with-header>
        <x-slot name="header">
            Boys Roster
        </x-slot>
        <livewire:main.team-roster />

    </x-card.card-with-header>

    <x-card.card-with-header>
        <x-slot name="header">
            Girls' Roster
        </x-slot>
        <livewire:main.team-roster />

    </x-card.card-with-header>

</div>
