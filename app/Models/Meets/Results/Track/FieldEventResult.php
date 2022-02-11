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

class FieldEventResult extends Model
{
    use HasFactory, ResultsTrait;

    protected $table='tf_meet_field_event_results';

    protected $fillable = [
        'track_event_id',
        'track_meet_id',
        'athlete_id',
        'gender_id',
        'total_inches',
        'quarter_inch',
        'place',
        'flight',
        'points'
    ];

    public function getMarkAttribute(): string
    {
        $inches = $this->attributes['total_inches'];
        $feet = floor($inches/12);
        $inches = ($inches%12);

        return  $feet . "' " . $inches;
    }

    public function getFractionAttribute(): ?string
    {
        if ($this->attributes['quarter_inch']) {
            $quarterInch = $this->attributes['sophomore_quarter_inch'];
            return ($quarterInch > 0) ? ltrim(number_format($quarterInch / 4, 2), 0)  : null;
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
