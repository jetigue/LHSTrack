<?php

namespace App\Models\Communication\EventSubtypes;

use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSubtypeAnnouncement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'event_subtype_announcements';
    protected $casts = [
        'begin_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function getBeginDateForEditingAttribute()
    {
        return $this->begin_date->format('m/d/Y');
    }

    public function getEndDateForEditingAttribute()
    {
        return $this->end_date->format('m/d/Y');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function eventSubtype(): BelongsTo
    {
        return $this->belongsTo(TrackEventSubtype::class, 'track_event_subtype_id');
    }
}
