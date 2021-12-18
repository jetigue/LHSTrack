<div class="flex flex-col w-full">
    <x-slot name="banner">
        @include('layouts.banner')
    </x-slot>

    <div class="grid grid-cols-6 gap-6  py-4 md:py-8 lg:py-12">
        <div class="grid col-span-6 lg:col-span-4">
            <livewire:main.welcome-page-announcements />
        </div>

        <div class="grid col-span-6 lg:col-span-2">
            <livewire:main.welcome-page-team-events />
        </div>
    </div>

</div>
