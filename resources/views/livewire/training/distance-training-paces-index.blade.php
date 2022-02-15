<div>
    <x-headings.page>
        <x-slot name="breadcrumbs">
            <x-breadcrumb.menu>
                <x-breadcrumb.item href="{{ route('Dashboard') }}" :leadingArrow="false">
                    Dashboard
                </x-breadcrumb.item>
            </x-breadcrumb.menu>
        </x-slot>
        Distance Training Paces
    </x-headings.page>

    <div class="text-gray-200">
        <ul>
            @foreach($athletes-> as $athlete)
                <li>{{$athlete->fullName}}</li>
            @endforeach

        </ul>
    </div>
</div>
