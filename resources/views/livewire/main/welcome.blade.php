<div class="w-full">
    <x-slot name="banner">
        @include('layouts.banner')
    </x-slot>

    <div class="grid grid-cols-6 gap-4 lg:gap-6">
        <div class="grid col-span-6 md:col-span-4">
            <livewire:main.welcome-page-announcements />
        </div>

        <div class="gird col-span-6 md:col-span-2">
            <livewire:main.welcome-page-team-events />
        </div>
    </div>

</div>
