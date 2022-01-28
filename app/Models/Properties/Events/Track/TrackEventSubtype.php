<?php

namespace App\Models\Properties\Events\Track;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrackEventSubtype extends Model
{
    use HasFactory;

    protected $table='track_event_subtypes';

    protected $fillable = ['name', 'track_event_type_id'];

    public function trackEvents(): HasMany
    {
        return $this->hasMany(TrackEvent::class);
    }

    public function eventType(): BelongsTo
    {
        return $this->belongsTo(TrackEventType::class, 'track_event_type_id');
    }

//    public function athletes(): hasMany
//    {
//        return $this->hasMany(Athlete::class);
//    }
}
