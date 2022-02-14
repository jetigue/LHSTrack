<div class="flex flex-col space-y-10">
    <div class="flex items-start">
        <div>
            @include('livewire.main._our-team-menu')
        </div>


        <div id="lettering-policy">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-light text-gray-500">
                Lettering Policy
            </h2>

            <div class="text-gray-300 leading-6 space-y-2">
                <p>All athletes must be in good standing with the coaching staff, meeting all academic and team
                    standards. Coaches have the right to award letters or refuse to award letters at their discretion,
                    in accordance with the criteria listed below and the guidelines of the Lambert High School Track &
                    Field Program.</p>
                <p>In order to earn a Varsity Letter, an athlete must meet one of the following requirements:</p>
                <div class="no-tailwindcss-base">
                    <ul>
                        <li>Earn 6 Team Points in a Varsity Meet</li>
                        <li>Compete in the Varsity Region Meet</li>
                        <li>Meet or better the grade-level Lettering Standards for any event listed below:</li>
                    </ul>
                </div>
            </div>

            <div class="w-full space-y-6 pb-10">
                @foreach($genders as $gender)
                    <div>
                        <x-headings.section>{{ $gender->name }} Standards</x-headings.section>
                        <livewire:team.lettering.event-lettering-marks-index :gender="$gender" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
