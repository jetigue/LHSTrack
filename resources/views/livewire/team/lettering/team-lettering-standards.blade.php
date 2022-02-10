<div>
    <x-flash />
    <x-headings.page>
        Team Lettering Standards
    </x-headings.page>

    <div class="w-full space-y-6 pb-10">

        @foreach($genders as $gender)
            <div>
                <x-headings.section>{{ $gender->name }} Standards</x-headings.section>
                <livewire:team.lettering.event-lettering-marks-index :gender="$gender" />
            </div>
        @endforeach

    </div>

</div>
