<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GirlsTrackMeetEvent extends Pivot
{
    use HasFactory;

    protected $table = 'girls_tf_meet_events';
}
