<?php

namespace App\Models\Team;

use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Races\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FieldEventLetteringMark extends Model
{
    use HasFactory;

    protected $table = 'field_event_lettering_marks';

    protected $fillable = [
        'track_event_id',
        'gender_id',
        'freshman_total_inches',
        'freshman_quarter_inch',
        'sophomore_total_inches',
        'sophomore_quarter_inch',
        'junior_total_inches',
        'junior_quarter_inch',
        'senior_total_inches',
        'senior_quarter_inch',
    ];

    public function trackEvent(): BelongsTo
    {
        return $this->belongsTo(TrackEvent::class, 'track_event_id');
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function getFreshmanMarkAttribute(): string
    {
        $inches = $this->attributes['freshman_total_inches'];
        $feet = floor($inches / 12);
        $inches = ($inches % 12);

        return  $feet."' ".$inches;
    }

    public function getFreshmanFractionAttribute(): ?string
    {
        if ($this->attributes['freshman_quarter_inch']) {
            $quarterInch = $this->attributes['freshman_quarter_inch'];

            return ($quarterInch > 0) ? ltrim(number_format($quarterInch / 4, 2), 0) : null;
        }

        return null;
    }

    public function getSophomoreMarkAttribute(): string
    {
        $inches = $this->attributes['sophomore_total_inches'];
        $feet = floor($inches / 12);
        $inches = ($inches % 12);

        return  $feet."' ".$inches;
    }

    public function getSophomoreFractionAttribute(): ?string
    {
        if ($this->attributes['sophomore_quarter_inch']) {
            $quarterInch = $this->attributes['sophomore_quarter_inch'];

            return ($quarterInch > 0) ? ltrim(number_format($quarterInch / 4, 2), 0) : null;
        }

        return null;
    }

    public function getJuniorMarkAttribute(): string
    {
        $inches = $this->attributes['junior_total_inches'];
        $feet = floor($inches / 12);
        $inches = ($inches % 12);

        return  $feet."' ".$inches;
    }

    public function getJuniorFractionAttribute(): ?string
    {
        if ($this->attributes['junior_quarter_inch']) {
            $quarterInch = $this->attributes['junior_quarter_inch'];

            return ($quarterInch > 0) ? ltrim(number_format($quarterInch / 4, 2), 0) : null;
        }

        return null;
    }

    public function getSeniorMarkAttribute(): string
    {
        $inches = $this->attributes['senior_total_inches'];
        $feet = floor($inches / 12);
        $inches = ($inches % 12);

        return  $feet."' ".$inches;
    }

    public function getSeniorFractionAttribute(): ?string
    {
        if ($this->attributes['senior_quarter_inch']) {
            $quarterInch = $this->attributes['senior_quarter_inch'];

            return ($quarterInch > 0) ? ltrim(number_format($quarterInch / 4, 2), 0) : null;
        }

        return null;
    }
}
