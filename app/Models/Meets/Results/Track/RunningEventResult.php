<?php

namespace App\Models\Meets\Results\Track;

use App\Models\Athletes\Athlete;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Traits\ResultsTrait;
use App\Traits\VDOTTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RunningEventResult extends Model
{
    use HasFactory, VDOTTrait, ResultsTrait;

    protected $table = 'tf_running_event_results';

    protected $fillable = [
        'track_event_id',
        'track_team_result_id',
        'athlete_id',
        'total_seconds',
        'milliseconds',
        'place',
        'heat',
        'points',
    ];

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
}
