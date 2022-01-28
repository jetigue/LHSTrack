<?php

namespace App\Models\Pivot;

use App\Models\Properties\Races\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GirlsTrackTimeTrialEvent extends Pivot
{
    protected $table = 'girls_tf_tt_events';

}
