<?php

namespace App\Models\Meets\Results\Track;

use App\Models\Athletes\Athlete;
use App\Models\Meets\TrackMeet;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Races\Gender;
use App\Traits\ResultsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RelayEventResult extends Model
{
    use HasFactory, ResultsTrait;

    protected $table = 'tf_meet_relay_event_results';

    protected $fillable = [
        'track_meet_id',
        'relay_team',
        'gender_id',
        'place',
        'total_seconds',
        'milliseconds',
        'leg_1_athlete_id',
        'leg_2_athlete_id',
        'leg_3_athlete_id',
        'leg_4_athlete_id',
        'leg_1_total_seconds',
        'leg_1_milliseconds',
        'leg_2_total_seconds',
        'leg_2_milliseconds',
        'leg_3_total_seconds',
        'leg_3_milliseconds',
        'leg_4_total_seconds',
        'leg_4_milliseconds',
        'points',
        'heat'
    ];

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

    public function firstAthlete(): BelongsTo
    {
        return $this->belongsTo(Athlete::class, 'leg_1_athlete_id');
    }

    public function secondAthlete(): BelongsTo
    {
        return $this->belongsTo(Athlete::class, 'leg_2_athlete_id');
    }

    public function thirdAthlete(): BelongsTo
    {
        return $this->belongsTo(Athlete::class, 'leg_3_athlete_id');
    }

    public function fourthAthlete(): BelongsTo
    {
        return $this->belongsTo(Athlete::class, 'leg_4_athlete_id');
    }
}
