<?php

namespace App\Models\Meets\Results\Track;

use App\Models\Athletes\Athlete;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Traits\ResultsTrait;
use App\Traits\VDOTTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RunningEventResult extends Model
{
    use HasFactory, VDOTTrait, ResultsTrait;

    protected $table='tf_running_event_results';

    protected $fillable = [
        'track_event_id',
        'track_team_result_id',
        'athlete_id',
        'total_seconds',
        'milliseconds',
        'place',
        'heat',
        'points'
    ];

//    protected $casts=['total_time' => 'float'];

//    protected $appends=['total_time'];

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

    public function trackEvent(): BelongsTo
    {
        return $this->belongsTo(TrackEvent::class, 'track_event_id');
    }

    public function athlete(): BelongsTo
    {
        return $this->belongsTo(Athlete::class, 'athlete_id');
    }

    public function teamResult(): BelongsTo
    {
        return $this->belongsTo(TeamResult::class, 'track_team_result_id');
    }
//
//    public function getTotalTimeAttribute(): Attribute
//    {
//        return $this->attributes['total_seconds'] + ($this->attributes['milliseconds'] / 100);
//    }
}
