<?php

namespace App\Http\Livewire\Meets\Track\Results;

use App\Models\Meets\Results\Track\TeamResult;
use Livewire\Component;

class ShowTeamResult extends Component
{
    public TeamResult $teamResult;

    public function render()
    {
        return view('livewire.meets.track.results.show-team-result', [
            'trackEvents' => $this->teamResult->trackEvents,

            'otherTeamResults' => TeamResult::query()
                ->where('track_meet_id', $this->teamResult->trackMeet->id)
                ->where('id', '!=', $this->teamResult->id)
                ->get(),
        ]);
    }
}
