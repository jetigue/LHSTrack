<div>
    <x-flash />
    <x-headings.page>
        <x-slot name="breadcrumbs">
            <x-breadcrumb.menu>
                <x-breadcrumb.item href="{{ route('Dashboard') }}" :leadingArrow="false">
                    Dashboard
                </x-breadcrumb.item>
            </x-breadcrumb.menu>
        </x-slot>
        Lettering Athletes
        <x-slot name="action">
            <div class="flex items-end space-x-2">
                <x-search />
            </div>
        </x-slot>
    </x-headings.page>

    <div class="space-y-4 flex flex-col w-full md:w-4/6">
        <x-table.table class="table-fixed relative">
            <x-slot name="head">
                <x-table.header-row>

                    <x-table.heading sortable
                                     wire:click="sortBy('last_name')"
                                     :direction="$sortField === 'last_name' ? $sortDirection : null"
                                     class="w-11/12 lg:w-6/12"
                    >
                        Name
                    </x-table.heading>

                    <x-table.heading sortable
                                     class="hidden lg:flex lg:w-2/12"
                    >
                        Status
                    </x-table.heading>
                    <x-table.heading class="flex w-1/12">

                    </x-table.heading>
                </x-table.header-row>
            </x-slot>

            <x-slot name="body">
                @forelse($athletes as $athlete)
                    <x-table.row
                        wire:key="{{ $loop->index }}"
                        x-data="{ show: false }" @mouseover="show=true" @mouseleave="show=false"
                        wire:loading.class.delay="opacity-50"
                    >
                        <x-table.cell class="w-11/12 lg:w-5/12">
                            <div class="flex flex-col">
                                <a href="{{ $athlete->path() }}"
                                   class="text-base hover:underline hover:font-bold">
                                    {{ $athlete->last_name }}, {{ $athlete->first_name }}
                                </a>
                                <div class="flex text-gray-400 text-sm space-x-4 pl-4">
                                    <span>{{ $athlete->grade }}</span>
                                </div>
                            </div>

                        </x-table.cell>
                        <x-table.cell class="hidden lg:flex lg:w-1/12">
                        </x-table.cell>

                        <x-table.cell
                            class="hidden lg:flex lg:w-3/12">
                        </x-table.cell>

                        <x-table.cell
                            class="hidden lg:inline-block lg:w-2/12 text-{{ $athlete->status_color }}-500">
                            {{ $athlete->current_status }}
                        </x-table.cell>
                        <x-table.cell class="w-1/12 flex justify-end">

                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row class="flex w-full">
                        <div class="flex flex-col items-center mx-auto">
                            <x-icon.user-group />
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No Athletes</h3>
                        </div>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table.table>


        <div class="text-gray-300">
            {{ $athletes->links() }}
        </div>
    </div>


</div>
