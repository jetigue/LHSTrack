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

    protected $table='tf_field_event_results';

    protected $fillable = [
        'track_team_result_id',
        'track_event_id',
        'athlete_id',
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
            $quarterInch = $this->attributes['quarter_inch'];
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

    public function teamResult(): BelongsTo
    {
        return $this->belongsTo(TeamResult::class, 'track_team_result_id');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($result) {

            switch($result->attributes['quarter_inch'])
            {
                case(1):
                    $fraction = 25;
                    break;
                case(2):
                    $fraction = 50;
                    break;
                case(3):
                    $fraction = 75;
                    break;
                default:
                    $fraction = null;
            }

            if ($fraction != null) {
                $result->total_distance = $result->attributes['total_inches'] + ($result->attributes['quarter_inch'] / 4);
            } else {
                $result->total_distance = $result->attributes['total_inches'];
            }

        });
    }
}
