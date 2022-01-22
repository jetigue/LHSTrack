<?php

namespace App\Models\Properties\Events;

use App\Models\Meets\TrackMeet;
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

    protected $fillable = ['name', 'distance_in_meters', 'event_category_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function competedAt(TrackMeet $trackMeet)
    {
        $this->trackMeets()->attach($trackMeet);
    }

    public function trackMeets(): BelongsToMany
    {
        return $this->belongsToMany(TrackMeet::class, 'track_meet_events');
    }

        public function timeTrials(): BelongsToMany
    {
        return $this->belongsToMany(TrackTimeTrial::class, 'track_trial_events')->using(TrackTimeTrialEvent::class);
    }
}
