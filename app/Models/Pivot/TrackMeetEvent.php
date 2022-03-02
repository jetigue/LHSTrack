<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TrackMeetEvent extends Pivot
{
    use HasFactory;

    protected $table = 'tf_meet_events';
}
