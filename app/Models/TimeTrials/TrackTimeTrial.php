<?php

namespace App\Models\TimeTrials;

use App\Models\Pivot\BoysTrackTimeTrialEvent;
use App\Models\Pivot\GirlsTrackTimeTrialEvent;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Properties\Meets\Timing;
use App\Models\Properties\Meets\Track\Venue;
use App\Models\TimeTrials\Results\Track\RunningEventResult;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class TrackTimeTrial extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'track_time_trials';

    protected $fillable = ['name', 'trial_date', 'track_venue_id', 'timing_method_id'];
    protected $casts = [
        'trial_date' => 'datetime',
    ];

    public function path(): string
    {
        return '/track/time-trials/'.$this->slug;
    }

    public function timingMethod(): BelongsTo
    {
        return $this->belongsTo(Timing::class, 'timing_method_id');
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class, 'track_venue_id');
    }

    public function getTrialDateForEditingAttribute()
    {
        return $this->trial_date->format('m/d/Y');
    }

    public function boysTrackEvents(): BelongsToMany
    {
        return $this->belongsToMany(TrackEvent::class, 'boys_tf_tt_events')->using(BoysTrackTimeTrialEvent::class)->withTimestamps();
    }

    public function girlsTrackEvents(): BelongsToMany
    {
        return $this->belongsToMany(TrackEvent::class, 'girls_tf_tt_events')->using(GirlsTrackTimeTrialEvent::class);
    }

    public function runningEventResults(): HasMany
    {
        return $this->hasMany(RunningEventResult::class);
    }

    public function eventSubtypes(): HasManyThrough
    {
        return $this->hasManyThrough(TrackEventSubtype::class, BoysTrackTimeTrialEvent::class, 'track_time_trial_id', 'id');
    }

//    public function girlsRunningEventResults(): HasMany
//    {
//        return $this->hasMany(RunningEventResult::class);
//    }

    public function getTrialDateForSlugAttribute()
    {
        return $this->trial_date->format('m-d-Y');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name',  'trialDateForSlug'],
            ],
        ];
    }
}
