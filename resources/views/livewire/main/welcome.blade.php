<div class="w-full">
    <x-slot name="banner">
        @include('layouts.banner')
    </x-slot>

    <div class="grid grid-cols-3 gap-6 py-8 lg:py-12">
        <div class="col-span-3 md:col-span-2">
            <livewire:main.welcome-page-announcements />
        </div>

        <div class="col-span-3 md:col-span-1">
            <livewire:main.welcome-page-team-events />
        </div>
    </div>

</div>
