<?php

namespace App\Models\Meets\Results\Track;

use App\Models\Athletes\Athlete;
use App\Models\Meets\TrackMeet;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Races\Gender;
use App\Traits\ResultsTrait;
use App\Traits\VDOTTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RunningEventResult extends Model
{
    use HasFactory, VDOTTrait, ResultsTrait;

    protected $table='tf_meet_running_event_results';

    protected $fillable = [
        'track_event_id',
        'track_meet_id',
        'athlete_id',
        'gender_id',
        'total_seconds',
        'milliseconds',
        'place',
        'heat',
        'points'
    ];

//    public function getTimeAttribute()
//    {
//        $seconds = $this->attributes['total_seconds'];
//
//        return $seconds > 59 ? gmdate('i:s', $seconds) : gmdate('s', $seconds);
//    }
//
//    public function getMillisecondsAttribute()
//    {
//        return $this->attributes['milliseconds'] > 9 ? $this->attributes['milliseconds'] : 0 . $this->attributes['milliseconds'];
//    }

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

    public function trackMeet(): BelongsTo
    {
        return $this->belongsTo(TrackMeet::class, 'track_meet_id');
    }
}
