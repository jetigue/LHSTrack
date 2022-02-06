<?php

namespace App\Models\Pivot;

use App\Models\Properties\Events\Track\TrackEventSubtype;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BoysTrackTimeTrialEvent extends Pivot
{
    protected $table = 'boys_tf_tt_events';
}
