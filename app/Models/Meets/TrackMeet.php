<?php

namespace App\Models\Meets;

use App\Models\Meets\Results\Track\TeamResult;
use App\Models\Pivot\BoysTrackMeetEvent;
use App\Models\Pivot\GirlsTrackMeetEvent;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Meets\Host;
use App\Models\Properties\Meets\Timing;
use App\Models\Properties\Meets\Track\MeetName;
use App\Models\Properties\Meets\Track\Season;
use App\Models\Properties\Meets\Track\Venue;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrackMeet extends Model
{
    use HasFactory, Sluggable;
    protected $casts = [
        'meet_date' => 'datetime',
    ];

    protected $fillable = [
        'host_id',
        'meet_date',
        'track_meet_name_id',
        'track_season_id',
        'track_venue_id',
        'timing_method_id',
        'meet_page_url',
    ];

    public function path(): string
    {
        return '/track/meets/'.$this->slug;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['meetName.name',  'meetYear'],
            ],
        ];
    }

    public function getMeetDateForEditingAttribute()
    {
        return $this->meet_date->format('m/d/Y');
    }

    public function getMeetYearAttribute()
    {
        return $this->meet_date->format('Y');
    }

    public function meetName(): BelongsTo
    {
        return $this->belongsTo(MeetName::class, 'track_meet_name_id');
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class, 'track_season_id');
    }

    public function host(): BelongsTo
    {
        return $this->belongsTo(Host::class, 'host_id');
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class, 'track_venue_id');
    }

    public function timingMethod(): BelongsTo
    {
        return $this->belongsTo(Timing::class, 'timing_method_id');
    }

    public function trackEvents(): BelongsToMany
    {
        return $this->belongsToMany(TrackEvent::class, 'track_meet_events');
    }

    public function boysTrackEvents(): BelongsToMany
    {
        return $this->belongsToMany(TrackEvent::class, 'boys_tf_meet_events')
            ->orderBy('distance_in_meters')
            ->using(BoysTrackMeetEvent::class)
            ->withTimestamps();
    }

    public function girlsTrackEvents(): BelongsToMany
    {
        return $this->belongsToMany(TrackEvent::class, 'girls_tf_meet_events')->using(GirlsTrackMeetEvent::class);
    }

    public function teamResults(): HasMany
    {
        return $this->hasMany(TeamResult::class);
    }
}
