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

    public function getTimeAttribute()
    {
        $seconds = $this->attributes['total_seconds'];

        return ltrim($seconds > 59 ? gmdate('i:s', $seconds) : gmdate('s', $seconds), 0);
    }

    public function getMillisecondsAttribute()
    {
        return $this->attributes['milliseconds'] > 9 ? $this->attributes['milliseconds'] : 0 . $this->attributes['milliseconds'];
    }
}
