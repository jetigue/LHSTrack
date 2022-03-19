<?php

namespace App\Http\Livewire\Team;

use App\Models\Athletes\Athlete;
use App\Models\Meets\Results\Track\RunningEventResult;
use App\Models\Properties\Events\Track\TrackEvent;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TrackRankings extends Component
{
    public $rank = 1;
    public $sex = '';
    public $grade = '';
    public $event = '';
    public $year;
    public string $showingSex = 'All';
    public string $showingGrade = 'All';
    public string $showingEvent = 'All';

    protected $queryString = ['event', 'grade', 'sex'];

    public function mount()
    {
        $this->year = Carbon::now()->year;
    }

    public function updatedSex()
    {
        if ($this->sex == 'm') {
            $this->showingSex = 'Boys';
        } elseif ($this->sex == 'f') {
            $this->showingSex = 'Girls';
        } else {
            $this->showingSex = 'All';
        }
    }

    public function updatedGrade()
    {
        if ($this->grade == $this->year) {
            $this->showingGrade = 'Seniors';
        } elseif ($this->grade == $this->year + 1) {
            $this->showingGrade = 'Juniors';
        } elseif ($this->grade == $this->year + 2) {
            $this->showingGrade = 'Sophomores';
        } elseif ($this->grade == $this->year + 3) {
            $this->showingGrade = 'Freshmen';
        } else {
            $this->showingGrade = 'All';
        }
    }

    public function updatedEvent()
    {
        if ($this->event != '') {
            $this->showingEvent = TrackEvent::where('id', $this->event)->value('name');
        } else {
            $this->showingEvent = 'All';
        }
    }

    public function clearFilters()
    {
        $this->sex = '';
        $this->grade = '';
        $this->event = '';
        $this->showingSex = 'All';
        $this->showingGrade = 'All';
        $this->showingEvent = 'All';
    }

    public function render()
    {
        return view('livewire.team.track-rankings', [

            'bestTimes' => RunningEventResult::with('athlete', 'trackEvent', 'teamResult')
                ->when($this->sex, function ($query) {
                    return $query->whereHas('athlete', function ($q) {
                        $q->where('sex', $this->sex);
                    });
                })
                ->when($this->grade, function ($query) {
                    return $query->whereHas('athlete', function ($q) {
                        $q->where('grad_year', $this->grade);
                    });
                })
                ->when($this->event, function ($query, $event) {
                    return $query->where('track_event_id', $event);
                })
                ->orderBy('total_time')
                ->get(),

//            'bestTimes' => RunningEventResult::with('athlete', 'trackEvent', 'teamResult')
//                ->join('athletes', 'tf_running_event_results.athlete_id', '=', 'athletes.id')
//                ->join('track_team_results', 'tf_running_event_results.track_team_result_id', '=', 'track_team_results.id')
//                ->join('track_meets', 'track_team_results.track_meet_id', '=', 'track_meets.id')
//                ->join('track_meet_names', 'track_meets.track_meet_name_id', '=', 'track_meet_names.id')
//                ->join('track_events', 'tf_running_event_results.track_event_id', '=', 'track_events.id')
//                ->select(
//                    DB::raw('min(total_time) as total_time'),
//                    'athletes.first_name',
//                    'athletes.last_name',
//                    'athletes.sex as sex',
//                    'athletes.grad_year as grad_year',
//                    'track_events.slug as event',
//                    'track_events.name as eventName',
//                    'track_meet_names.name as trackMeet',
//                    'track_meets.meet_date as meetDate'
//                )
//                ->groupBy('athlete_id', 'track_event_id')
//                ->addSelect('track_meet_names.name as trackMeet', 'track_meets.meet_date as meetDate')
//                    DB::raw('min(total_seconds) as total_seconds'),
//                    DB::raw('min(milliseconds) as milliseconds'),
//                    DB::raw('min(track_meet_names.name) as trackMeet'),
//                    DB::raw('min(track_meets.meet_date) as meetDate'))
//                ->orderBy('total_time')
//                ->when($this->sex, function ($query, $sex) {
//                    return $query->where('sex', $sex);
//                    })
//                ->when($this->grade, function ($query, $grade) {
//                    return $query->where('grad_year', $grade);
//                    })
//                ->when($this->event, function ($query, $event) {
//                    return $query->where('track_events.slug', $event);
//                    })
//            ->get(),

            'runningEvents' => TrackEvent::with('eventSubType', 'runningEventResults')
                ->whereHas('eventSubtype', function ($query) {
                    $query->whereIn('name', ['Distance', 'Sprints', 'Hurdles'])->orderBy('distance_in_meters');
                })
                ->get()

        ]);
    }
}
