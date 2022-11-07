<?php

namespace App\Http\Livewire\Meets\Track\Results;

use App\Models\Meets\Results\Track\TeamResult;
use App\Models\Properties\Events\Track\TrackEvent;
use Livewire\Component;
use function view;

class TeamResultsEventResultsIndex extends Component
{
    public TeamResult $teamResult;

    public TrackEvent $trackEvent;

    public function render()
    {
        return view('livewire.meets.track.results.team-results-event-results-index', [
            'trackEvents' => $this->teamResult->trackEvents,

            'otherTeamResults' => TeamResult::query()
                ->where('track_meet_id', $this->teamResult->trackMeet->id)
                ->where('id', '!=', $this->teamResult->id)
                ->get(),
        ]);
    }
}
