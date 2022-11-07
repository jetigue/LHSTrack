<?php

namespace App\Models\TimeTrials\Results\Track;

use App\Models\Athletes\Athlete;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Races\Gender;
use App\Models\TimeTrials\TrackTimeTrial;
use App\Traits\ResultsTrait;
use App\Traits\VDOTTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RunningEventResult extends Model
{
    use HasFactory, ResultsTrait, VDOTTrait;

    protected $table = 'tf_tt_running_event_results';

    protected $fillable = [
        'track_event_id',
        'track_time_trial_id',
        'athlete_id',
        'total_seconds',
        'milliseconds',
        'place',
        'heat',
        'gender_id',
    ];

    public function distance()
    {
        $meters = $this->trackEvent->distance_in_meters;

        if ($meters >= 1600) {
            return $meters;
        }

        return null;
    }

    public function athlete(): BelongsTo
    {
        return $this->belongsTo(Athlete::class, 'athlete_id');
    }

    public function trackEvent(): BelongsTo
    {
        return $this->belongsTo(TrackEvent::class, 'track_event_id');
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function timeTrial(): BelongsTo
    {
        return $this->belongsTo(TrackTimeTrial::class, 'track_time_trial_id');
    }
}
