<?php

namespace App\Models\Properties\Events\Track;

use App\Models\Meets\Results\Track\FieldEventResult;
use App\Models\Meets\Results\Track\RelayEventResult;
use App\Models\Meets\Results\Track\RunningEventResult;
use App\Models\Meets\Results\Track\TeamResult;
use App\Models\Meets\TrackMeet;
use App\Models\Pivot\BoysTrackMeetEvent;
use App\Models\Pivot\BoysTrackTimeTrialEvent;
use App\Models\Pivot\GirlsTrackMeetEvent;
use App\Models\Pivot\GirlsTrackTimeTrialEvent;
use App\Models\Pivot\TrackMeetEvent;
//use App\Models\TimeTrials\Results\BoysRunningEventResult;
use App\Models\TimeTrials\TrackTimeTrial;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrackEvent extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'track_events';

    protected $fillable = [
        'name',
        'distance_in_meters',
        'track_event_subtype_id',
        'boys_event',
        'girls_event',
        'ghsa_event',
    ];

    public function eventSubtype(): BelongsTo
    {
        return $this->belongsTo(TrackEventSubtype::class, 'track_event_subtype_id');
    }

    public function trackMeets(): BelongsToMany
    {
        return $this->belongsToMany(TrackMeet::class, 'track_meet_events');
    }

    public function boysTimeTrials(): BelongsToMany
    {
        return $this->belongsToMany(TrackTimeTrial::class, 'boys_tf_tt_events')
            ->using(BoysTrackTimeTrialEvent::class)
            ->withTimestamps();
    }

    public function girlsTimeTrials(): BelongsToMany
    {
        return $this->belongsToMany(TrackTimeTrial::class, 'girls_tf_tt_events')
            ->using(GirlsTrackTimeTrialEvent::class)
            ->withTimestamps();
    }

//    public function boysTrackMeets(): BelongsToMany
//    {
//        return $this->belongsToMany(TrackMeet::class, 'boys_tf_meet_events')
//            ->using(BoysTrackMeetEvent::class)
//            ->withTimestamps();
//    }

//    public function girlsTrackMeets(): BelongsToMany
//    {
//        return $this->belongsToMany(TrackMeet::class, 'girls_tf_meet_events')
//            ->using(GirlsTrackMeetEvent::class)
//            ->withTimestamps();
//    }

    public function teamResults(): BelongsToMany
    {
        return $this->belongsToMany(TeamResult::class, 'tf_meet_events')
            ->using(TrackMeetEvent::class)
            ->withTimestamps();
    }

    public function runningEventResults(): HasMany
    {
        return $this->hasMany(RunningEventResult::class);
    }

    public function fieldEventResults(): HasMany
    {
        return $this->hasMany(FieldEventResult::class);
    }

    public function relayEventResults(): HasMany
    {
        return $this->hasMany(RelayEventResult::class);
    }

//    public function boysRunningEventResults(): HasMany
//    {
//        return $this->hasMany(BoysRunningEventResult::class);
//    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
