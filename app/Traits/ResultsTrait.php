<?php

namespace App\Traits;

trait ResultsTrait
{
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

    public function getTimeAttribute(): string
    {
        $seconds = $this->attributes['total_seconds'];

        return ltrim($seconds > 59 ? gmdate('i:s', $seconds) : gmdate('s', $seconds), 0);
    }

    public function getMillisecondsAttribute()
    {
        return $this->attributes['milliseconds'] > 9 ? $this->attributes['milliseconds'] : 0 . $this->attributes['milliseconds'];
    }

    public function getFirstLegTimeAttribute(): string
    {
        $seconds = $this->attributes['leg_1_total_seconds'];

        return ltrim($seconds > 59 ? gmdate('i:s', $seconds) : gmdate('s', $seconds), 0);
    }

    public function getFirstLegMillisecondsAttribute()
    {
        return $this->attributes['leg_1_milliseconds'] > 9 ? $this->attributes['leg_1_milliseconds'] : 0 . $this->attributes['leg_1_milliseconds'];
    }

    public function getSecondLegTimeAttribute(): string
    {
        $seconds = $this->attributes['leg_2_total_seconds'];

        return ltrim($seconds > 59 ? gmdate('i:s', $seconds) : gmdate('s', $seconds), 0);
    }

    public function getSecondLegMillisecondsAttribute()
    {
        return $this->attributes['leg_2_milliseconds'] > 9 ? $this->attributes['leg_2_milliseconds'] : 0 . $this->attributes['leg_1_milliseconds'];
    }

    public function getThirdLegTimeAttribute(): string
    {
        $seconds = $this->attributes['leg_3_total_seconds'];

        return ltrim($seconds > 59 ? gmdate('i:s', $seconds) : gmdate('s', $seconds), 0);
    }

    public function getThirdLegMillisecondsAttribute()
    {
        return $this->attributes['leg_3_milliseconds'] > 9 ? $this->attributes['leg_3_milliseconds'] : 0 . $this->attributes['leg_1_milliseconds'];
    }

    public function getFourthLegTimeAttribute(): string
    {
        $seconds = $this->attributes['leg_4_total_seconds'];

        return ltrim($seconds > 59 ? gmdate('i:s', $seconds) : gmdate('s', $seconds), 0);
    }

    public function getFourthLegMillisecondsAttribute()
    {
        return $this->attributes['leg_4_milliseconds'] > 9 ? $this->attributes['leg_4_milliseconds'] : 0 . $this->attributes['leg_1_milliseconds'];
    }
}
