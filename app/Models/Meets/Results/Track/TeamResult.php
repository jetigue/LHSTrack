<?php

namespace App\Models\Meets\Results\Track;

use App\Models\Meets\TrackMeet;
use App\Models\Pivot\TrackMeetEvent;
use App\Models\Properties\Events\Track\TrackEvent;
use App\Models\Properties\Races\Division;
use App\Traits\ResultsTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeamResult extends Model
{
    use HasFactory, ResultsTrait, Sluggable;

    protected $table = 'track_team_results';

    protected $fillable = [
        'track_meet_id',
        'division_id',
        'place',
        'number_teams',
        'points',
        'notes',
    ];

    public function path(): string
    {
        return '/track/meets/team-results/'.$this->slug;
    }

    public function trackMeet(): BelongsTo
    {
        return $this->belongsTo(TrackMeet::class, 'track_meet_id');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function trackEvents(): BelongsToMany
    {
        return $this->belongsToMany(TrackEvent::class, 'tf_meet_events', 'track_team_result_id')
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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['trackMeet.meetName.name',  'trackMeet.meetYear', 'division.level.name', 'division.gender.name'],
            ],
        ];
    }
}
