<?php

namespace App\Http\Livewire\Main;

use App\Models\Athletes\Athlete;
use Carbon\Carbon;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Request;

class TeamRoster extends Component
{
    public $freshmen;
    public $sophomores;
    public $juniors;
    public $seniors;
    public $gender;

    public function mount(Request $request)
    {
        $sex = $request->getRequestUri() == '/girls-roster' ? 'f' : 'm';

        $nextSeason = Carbon::now()->month >= 6 ? 1 : 0;

        if ($sex == 'm') { $this->gender = 'Boys\''; } $this->gender = 'Girls\'';

        $athletes = Athlete::query()
//            ->where('status', '=', 'a')
            ->where('sex', '=', $sex)
            ->orderBy('last_name')
            ->get();

        $seniors = clone $athletes->where('grad_year', '=', Carbon::now()->year + 0 + $nextSeason);
        $juniors = clone $athletes->where('grad_year', '=', Carbon::now()->year + 1 + $nextSeason);
        $sophomores = clone $athletes->where('grad_year', '=', Carbon::now()->year + 2 + $nextSeason);
        $freshmen = clone $athletes->where('grad_year', '=', Carbon::now()->year + 3 + $nextSeason);

        $gender = $request->getRequestUri() == '/girls-roster' ? 'Girls\'' : 'Boys\'';

        $this->freshmen = $freshmen;
        $this->sophomores = $sophomores;
        $this->juniors = $juniors;
        $this->seniors = $seniors;
        $this->gender = $gender;
    }

    public function render()
    {
        return view('livewire.main.team-roster');
    }
}
