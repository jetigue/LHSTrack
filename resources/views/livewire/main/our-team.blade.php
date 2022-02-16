<div class="">
    <x-headings.page class="">
        Our Team
    </x-headings.page>

    <div class="flex w-full px-4 md:px-2 lg:px-0">
        <div class="flex flex-col w-full">
            <livewire:main.team-roster />

            <div id="coaches" class="flex w-full items-start py-20">
                <div class="">
                    @include('livewire.main._our-team-menu')
                </div>

                <div class="flex flex-col">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-light text-gray-500">
                        Coaching Staff
                    </h2>
                    <ul class="space-y-4 py-4">
                        <li class="flex-col">
                            <div class="flex items-center">
                                <h3 class="text-gray-200 md:text-lg truncate">Coach Tigue, Head Coach and Distance
                                    Coach</h3>
                                <a href="mailto:coachtigue@gmail.com"
                                   class="px-4 text-gray-400 hover:text-gray-200">
                                    <x-icon.mail class=" h-5 w-5" />
                                </a>
                            </div>
                            <div class="text-gray-400 space-y-3 py-2">
                                <p>
                                    Coach Tigue has been coaching Track & Field and Cross Country for 18 years. In
                                    high school he competed in the High Jump, 400m Run, 800m Run, and the 1600m Run.
                                    After high school he ran Cross Country and Track at Berry College, where he
                                    primarily competed in the 5000m Run during the Track season.
                                </p>
                                <p>
                                    This is Coach Tigue's 8th year as Lambert's Cross Country and Distance Coach and his
                                    first year as the Track program's Head Coach. Prior to that, Coach Tigue coached
                                    at his alma mater, Parkview High School.
                                </p>
                                <p>
                                    He has been fortunate enough to have the opportunity to coach some very talented and
                                    even more not-so-talented athletes
                                    in his career and still looks forward to working with them every day.
                                </p>
                            </div>

                        </li>
                        <li class="flex-col">
                            <h3 class="text-gray-300 text-lg">Coach Leonard, Jumps Coach</h3>
                        </li>
                        <li class="flex-col">
                            <h3 class="text-gray-300 text-lg">Coach Moran, Sprints Coach</h3>
                        </li>
                        <li class="flex-col">
                            <h3 class="text-gray-300 text-lg">Coach Negley, Pole Vault Coach</h3>
                        </li>
                        <li class="flex-col">
                            <h3 class="text-gray-300 text-lg">Coach Donnel, Throws Coach</h3>
                        </li>
                        <li class="flex-col">
                            <h3 class="text-gray-300 text-lg">Coach Maynard, Hurdles Coach</h3>
                        </li>
                    </ul>
                </div>
            </div>

{{--            <div id="booster-club" class="flex w-full items-start">--}}
{{--                <div class="">--}}
{{--                    @include('livewire.main._our-team-menu')--}}
{{--                </div>--}}

{{--                <div class="flex flex-col">--}}
{{--                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-light text-gray-500">--}}
{{--                        Booster Club--}}
{{--                    </h2>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="flex w-full">
                <livewire:team.lettering.team-lettering-standards />
            </div>
        </div>
    </div>


</div>
