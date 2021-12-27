<div class="w-full">
    <x-slot name="banner">
        @include('layouts.banner')
    </x-slot>

    <div class="grid grid-cols-6 gap-6 pt-4">
        <div class="sm:col-span-6 md:col-span-4">
            <livewire:main.welcome-page-announcements />
        </div>

        <div class="sm:col-span-3 md:col-span-2">
            <livewire:main.welcome-page-team-events />
        </div>
    </div>

</div>
