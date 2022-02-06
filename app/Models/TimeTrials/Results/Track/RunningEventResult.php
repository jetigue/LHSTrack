<?php

namespace App\Models\TimeTrials\Results\Track;

use App\Models\Athletes\Athlete;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Races\Gender;
use App\Models\TimeTrials\TrackTimeTrial;
use App\Traits\VDOTTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RunningEventResult extends Model
{
    use HasFactory, VDOTTrait;

    protected $table = 'tf_tt_running_event_results';

    protected $fillable = [
        'track_event_id',
        'track_time_trial_id',
        'athlete_id',
        'total_seconds',
        'milliseconds',
        'place',
        'heat',
        'gender_id'
    ];

    public function getTimeAttribute()
    {
        $seconds = $this->attributes['total_seconds'];

        return $seconds > 59 ? gmdate('i:s', $seconds) : gmdate('s', $seconds);
    }

    public function getMillisecondsAttribute()
    {
        return $this->attributes['milliseconds'] > 9 ? $this->attributes['milliseconds'] : 0 . $this->attributes['milliseconds'];
    }

    public function getPlaceWithSuffixAttribute(): string
    {
        $value = $this->attributes['place'];

        if ($value != null) {
            if (! in_array(($value % 100), [11, 12, 13])) {
                switch ($value % 10) {
                    // Handle 1st, 2nd, 3rd
                    case 1:
                        return $value.'st';
                    case 2:
                        return $value.'nd';
                    case 3:
                        return $value.'rd';
                }
            }
            return $value.'th';
        }
        return $value;
    }

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
