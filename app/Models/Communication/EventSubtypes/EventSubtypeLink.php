<?php

namespace App\Models\Communication\EventSubtypes;

use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSubtypeLink extends Model
{
    use HasFactory;

    protected $table = 'event_subtype_links';

    protected $fillable = ['track_event_subtype_id', 'user_id', 'text', 'url'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function eventSubtype(): BelongsTo
    {
        return $this->belongsTo(TrackEventSubtype::class, 'track_event_subtype_id');
    }
}
