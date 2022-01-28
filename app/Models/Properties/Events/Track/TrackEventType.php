<?php

namespace App\Models\Properties\Events\Track;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class TrackEventType extends Model
{
    use HasFactory;

    protected $table = 'track_event_types';

    protected $fillable = ['name'];

    public function subTypes(): HasMany
    {
        return $this->hasMany(TrackEventSubtype::class);
    }

    public function trackEvents(): HasManyThrough
    {
        return $this->hasManyThrough(TrackEvent::class, TrackEventSubtype::class);
    }
}
