<div class="flex flex-col space-y-10 w-full">
    <div class="flex items-start w-full">
        @include('livewire.main._our-team-menu')

        <div id="boys-roster" class="w-full">
               <h2 class="text-2xl md:text-3xl lg:text-4xl font-light text-gray-500 w-full">
                   Boys Roster
               </h2>
               <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 lg:px-8 font-semibold text-gray-400 py-4 w-full">
                   <div class="col-span-1">
                       <h3 class="text-xl text-gray-200 py-2">Seniors</h3>
                       <ul class="space-y-2.5 py-2">
                           @foreach($athletes->where('grad_year', '==', ($this->currentYear + $this->nextSeason))->where('sex', 'm') as $senior)
                               <li>
                                   <a class="hover:underline" href="{{ $senior->path() }}">{{ $senior->fullname }}</a>
                               </li>
                           @endforeach
                       </ul>
                   </div>
                   <div class="col-span-1">
                       <h3 class="text-xl text-gray-200 py-2">Juniors</h3>
                       <ul class="space-y-2.5 py-2">
                           @foreach($athletes->where('grad_year', '==', ($this->currentYear + 1 + $this->nextSeason))->where('sex', 'm') as $junior)
                               <li>
                                   <a class="hover:underline" href="{{ $junior->path() }}">{{ $junior->fullName }}</a>
                               </li>
                           @endforeach
                       </ul>
                   </div>

                   <div class="col-span-1">
                       <h3 class="text-xl text-gray-200 py-2">Sophomores</h3>
                       <ul class="space-y-2.5 py-2">
                           @foreach($athletes->where('grad_year', '==', ($this->currentYear + 2 + $this->nextSeason))->where('sex', 'm') as $sophomore)
                               <li>
                                   <a class="hover:underline" href="{{ $sophomore->path() }}">{{ $sophomore->fullName }}</a>
                               </li>
                           @endforeach
                       </ul>
                   </div>

                   <div class="col-span-1">
                       <h3 class="text-xl text-gray-200 py-2">Freshmen</h3>
                       <ul class="space-y-2.5 py-2">
                           @foreach($athletes->where('grad_year', '==', ($this->currentYear + 1 + $this->nextSeason))->where('sex', 'm') as $freshman)
                               <li>
                                   <a class="hover:underline" href="{{ $freshman->path() }}">{{ $freshman->fullName }}</a>
                               </li>
                           @endforeach
                       </ul>
                   </div>
               </div>
           </div>
    </div>

    <div class="flex items-start">
        @include('livewire.main._our-team-menu')

        <div id="girls-roster" class="w-full">
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-light text-gray-500">
            Girls Roster
        </h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 lg:px-8 font-semibold text-gray-400 py-4">
            <div class="col-span-1">
                <h3 class="text-xl text-gray-200 py-2">Seniors</h3>
                <ul class="space-y-2.5 py-2">
                    @foreach($athletes->where('grad_year', '==', ($this->currentYear + $this->nextSeason))->where('sex', 'f') as $senior)
                        <li>
                            <a class="hover:underline" href="{{ $senior->path() }}">{{ $senior->fullname }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-span-1">
                <h3 class="text-xl text-gray-200 py-2">Juniors</h3>
                <ul class="space-y-2.5 py-2">
                    @foreach($athletes->where('grad_year', '==', ($this->currentYear + 1 + $this->nextSeason))->where('sex', 'f') as $junior)
                        <li>
                            <a class="hover:underline" href="{{ $junior->path() }}">{{ $junior->fullName }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-span-1">
                <h3 class="text-xl text-gray-200 py-2">Sophomores</h3>
                <ul class="space-y-2.5 py-2">
                    @foreach($athletes->where('grad_year', '==', ($this->currentYear + 2 + $this->nextSeason))->where('sex', 'f') as $sophomore)
                        <li>
                            <a class="hover:underline" href="{{ $sophomore->path() }}">{{ $sophomore->fullName }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-span-1">
                <h3 class="text-xl text-gray-200 py-2">Freshmen</h3>
                <ul class="space-y-2.5 py-2">
                    @foreach($athletes->where('grad_year', '==', ($this->currentYear + 1 + $this->nextSeason))->where('sex', 'f') as $freshman)
                        <li>
                            <a class="hover:underline" href="{{ $freshman->path() }}">{{ $freshman->fullName }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    </div>




</div>
