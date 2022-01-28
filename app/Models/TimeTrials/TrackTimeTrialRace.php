<?php

namespace App\Models\TimeTrials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackTimeTrialRace extends Model
{
    use HasFactory;

    protected $table = 'track_tt_races';

    protected $fillable = [
        'track_time_trial_id',
        'gender_id',
        'track_event_id',
        'notes'
    ];
}
