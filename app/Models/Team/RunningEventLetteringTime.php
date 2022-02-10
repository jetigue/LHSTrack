<?php

namespace App\Models\Team;

use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Races\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RunningEventLetteringTime extends Model
{
    use HasFactory;

    protected $table = 'running_event_lettering_times';

    protected $fillable = [
        'track_event_id',
        'gender_id',
        'freshman_total_seconds',
        'freshman_milliseconds',
        'sophomore_total_seconds',
        'sophomore_milliseconds',
        'junior_total_seconds',
        'junior_milliseconds',
        'senior_total_seconds',
        'senior_milliseconds'
    ];

    public function trackEvent(): BelongsTo
    {
        return $this->belongsTo(TrackEvent::class, 'track_event_id');
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function getFreshmanTimeAttribute()
    {
        $seconds = $this->attributes['freshman_total_seconds'];

        return $seconds > 59 ? gmdate('i:s', $seconds) : gmdate('s', $seconds);
    }

    public function getSophomoreTimeAttribute()
    {
        $seconds = $this->attributes['sophomore_total_seconds'];

        return $seconds > 59 ? gmdate('i:s', $seconds) : gmdate('s', $seconds);
    }

    public function getJuniorTimeAttribute()
    {
        $seconds = $this->attributes['junior_total_seconds'];

        return $seconds > 59 ? gmdate('i:s', $seconds) : gmdate('s', $seconds);
    }

    public function getSeniorTimeAttribute()
    {
        $seconds = $this->attributes['senior_total_seconds'];

        return $seconds > 59 ? gmdate('i:s', $seconds) : gmdate('s', $seconds);
    }

    public function getFreshmanMillisecondsForHumansAttribute()
    {
        if ($this->attributes['freshman_milliseconds']) {
            $ms = $this->attributes['freshman_milliseconds'];

            return $ms > 9 ? $ms : 0 . $ms;
        }
        return null;
    }

    public function getSophomoreMillisecondsForHumansAttribute()
    {
        if ($this->attributes['sophomore_milliseconds']) {
            $ms = $this->attributes['sophomore_milliseconds'];

            return $ms > 9 ? $ms : 0 . $ms;
        }
        return null;
    }

    public function getJuniorMillisecondsForHumansAttribute()
    {
        if ($this->attributes['junior_milliseconds']) {
            $ms = $this->attributes['junior_milliseconds'];

            return $ms > 9 ? $ms : 0 . $ms;
        }
        return null;
    }

    public function getSeniorMillisecondsForHumansAttribute()
    {
        if ($this->attributes['senior_milliseconds']) {
            $ms = $this->attributes['senior_milliseconds'];

            return $ms > 9 ? $ms : 0 . $ms;
        }
        return null;
    }
}
