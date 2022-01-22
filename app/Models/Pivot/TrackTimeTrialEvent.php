<?php

namespace App\Models\Pivot;

use App\Models\Properties\Events\EventCategory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TrackTimeTrialEvent extends Pivot
{
    protected $table = 'track_trial_events';

}
