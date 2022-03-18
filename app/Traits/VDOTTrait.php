<?php
namespace App\Traits;

trait VDOTTrait
{
    public function distance()
    {
        $meters = $this->trackEvent->distance_in_meters;

        if ($meters >= 1500) {
            return $meters;
        }
        return null;
    }

    /**
     * Save the VDOT value on store and update.
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($result) {

            $result->total_time = $result->attributes['total_seconds'] + ($result->attributes['milliseconds'] / 100);

            if ($result->distance()) {
                $time = $result->attributes['total_seconds'];
                $minutes = $time / 60;
                $distance = $result->distance();
                $velocity = $distance / $minutes;
                $v2 = $velocity * $velocity;
                $percentVO2max = (.8 + .189439 * exp(-.01278 * $minutes)) + (.2989558 * exp(-.1932605 * $minutes));
                $result->vdot = round((-4.6 + .182258 * $velocity + .000104 * $v2)/$percentVO2max, 1);
            }
        });
    }
}
