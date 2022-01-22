<?php

namespace App\Models\TimeTrials;

use App\Models\Pivot\TrackTimeTrialEvent;
use App\Models\Properties\Events\EventCategory;
use App\Models\Properties\Events\TrackEvent;
use App\Models\Properties\Meets\Timing;
use App\Models\Properties\Meets\Track\Venue;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TrackTimeTrial extends Model
{
    use HasFactory, Sluggable;

    protected $table = "track_time_trials";

    protected $fillable = ['name', 'trial_date', 'track_venue_id', 'timing_method_id'];

    protected $dates = ['trial_date'];

    public function path(): string
    {
        return '/track-time-trials/' . $this->slug;
    }

    public function timingMethod(): BelongsTo
    {
        return $this-> belongsTo(Timing::class, 'timing_method_id');
    }

    public function venue(): BelongsTo
    {
        return $this-> belongsTo(Venue::class, 'track_venue_id');
    }

    public function getTrialDateForEditingAttribute()
    {
        return $this->trial_date->format('m/d/Y');
    }

    public function trackEvents(): BelongsToMany
    {
        return $this->belongsToMany(TrackEvent::class, 'track_trial_events')->using(TrackTimeTrialEvent::class);
    }

//    public function eventCategories()
//    {
//        return $this->hasManyThrough(EventCategory::class, TrackTimeTrialEvent::class, 'track_event_id', 'track_event_id', 'id', 'track_event_id' );
//    }

    public function getTrialDateForSlugAttribute()
    {
        return $this->trial_date->format('m-d-Y');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name',  'trialDateForSlug']
            ]
        ];
    }
}
