<div class="flex flex-col w-full">
    <x-slot name="banner">
        @include('layouts.banner')
    </x-slot>

    <div class="flex w-full flex-wrap py-8">
        <div class="flex w-full lg:w-2/3 py-2">
            <livewire:main.welcome-page-announcements />
        </div>

        <div class="flex w-full lg:w-1/3 py-2 lg:pl-6">
            <div class="w-full">
                <livewire:main.welcome-page-team-events />
            </div>

        </div>
    </div>

</div>
