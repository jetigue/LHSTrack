<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BoysTrackMeetEvent extends Pivot
{
    use HasFactory;

    protected $table = 'boys_tf_meet_events';
}
