<?php

namespace App\Models\Properties\Meets\Track;

use App\Models\Meets\TrackMeet;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MeetName extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'track_meet_names';

    protected $fillable = ['name'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function path(): string
    {
        return '/track/meet-names/'.$this->slug;
    }

    public function trackMeets(): HasMany
    {
        return $this->hasMany(TrackMeet::class);
    }
}
