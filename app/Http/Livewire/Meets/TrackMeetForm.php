<?php

namespace App\Http\Livewire\Meets;

use App\Models\Meets\TrackMeet;
use App\Models\Properties\Meets\Host;
use App\Models\Properties\Meets\Timing;
use App\Models\Properties\Meets\Track\MeetName;
use App\Models\Properties\Meets\Track\Season;
use App\Models\Properties\Meets\Track\Venue;
use Livewire\Component;

class TrackMeetForm extends Component
{
    public $trackMeet = null;
    public $host_id;
    public $meet_date_for_editing;
    public $meet_page_url;
    public $timing_method_id;
    public $track_meet_name_id;
    public $track_season_id;
    public $track_venue_id;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editTrackMeet'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editTrackMeet(TrackMeet $trackMeet)
    {
        $this->trackMeet = $trackMeet;
        $this->host_id = $this->trackMeet->host_id;
        $this->meet_date_for_editing = $this->trackMeet->meet_date_for_editing;
        $this->meet_page_url = $this->trackMeet->meet_page_url;
        $this->timing_method_id = $this->trackMeet->timing_method_id;
        $this->track_meet_name_id = $this->trackMeet->track_meet_name_id;
        $this->track_season_id = $this->trackMeet->track_season_id;
        $this->track_venue_id = $this->trackMeet->track_venue_id;
    }

    public function rules()
    {
        return [
            'host_id' => 'required|integer',
            'meet_date_for_editing' => 'required|date',
            'meet_page_url' => 'nullable|url',
            'timing_method_id' => 'required|integer',
            'track_meet_name_id' => 'required|integer',
            'track_season_id' => 'required|integer',
            'track_venue_id' => 'required|integer'
        ];
    }

    public function submitForm()
    {
        $this->validate();

        $trackMeet = [
            'host_id' => $this->host_id,
            'meet_date' => $this->meet_date_for_editing,
            'meet_page_url' => $this->meet_page_url,
            'timing_method_id' => $this->timing_method_id,
            'track_meet_name_id' => $this->track_meet_name_id,
            'track_season_id' => $this->track_season_id,
            'track_venue_id' => $this->track_venue_id,
        ];

        if ($this->trackMeet) {
            TrackMeet::find($this->trackMeet->id)->update($trackMeet);
            $this->emit('recordUpdated');
        } else {
            $trackMeet = TrackMeet::create($trackMeet);
            $this->emit('recordAdded');
        }
        $this->resetForm();
        $this->emit('hideFormModal');
    }

    public function resetForm()
    {
        $this->reset([
            'host_id',
            'meet_date_for_editing',
            'meet_page_url',
            'timing_method_id',
            'track_meet_name_id',
            'track_season_id',
            'track_venue_id',
        ]);
    }

    public function render()
    {
        return view('livewire.meets.track-meet-form', [
            'trackMeetNames' => MeetName::orderBy('name')->get(),
            'hosts' => Host::orderBy('name')->get(),
            'trackVenues' => Venue::orderBy('name')->get(),
            'timingMethods' => Timing::orderBy('name')->get(),
            'trackSeasons' => Season::orderBy('name')->get(),
        ]);
    }
}
