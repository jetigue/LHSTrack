<?php

namespace App\Models\Properties\Events\Track;

use App\Models\Meets\TrackMeet;
use App\Models\Pivot\BoysTrackTimeTrialEvent;
use App\Models\Pivot\GirlsTrackTimeTrialEvent;
use App\Models\Pivot\TrackTimeTrialEvent;
use App\Models\TimeTrials\TrackTimeTrial;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TrackEvent extends Model
{
    use HasFactory;

    protected $table = 'track_events';

    protected $fillable = [
        'name',
        'distance_in_meters',
        'track_event_subtype_id',
        'boys_event',
        'girls_event',
        'ghsa_event'
    ];

    public function eventSubtype(): BelongsTo
    {
        return $this->belongsTo(TrackEventSubtype::class, 'track_event_subtype_id');
    }

    public function competedAt(TrackMeet $trackMeet)
    {
        $this->trackMeets()->attach($trackMeet);
    }

    public function trackMeets(): BelongsToMany
    {
        return $this->belongsToMany(TrackMeet::class, 'track_meet_events');
    }

    public function boysTimeTrials(): BelongsToMany
    {
        return $this->belongsToMany(TrackTimeTrial::class, 'boys_tf_tt_events')->using(BoysTrackTimeTrialEvent::class);
    }

    public function girlsTimeTrials(): BelongsToMany
    {
        return $this->belongsToMany(TrackTimeTrial::class, 'girls_tf_tt_events')->using(GirlsTrackTimeTrialEvent::class);
    }
}
