<?php

namespace App\Models\Training\Workouts;

use App\Models\Properties\Events\Track\TrackEventSubtype;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSubtypeWorkout extends Model
{
    use HasFactory;

    protected $table = 'event_subtype_workouts';
    protected $casts = [
        'workout_date' => 'datetime',
    ];

    protected $fillable = [
        'title', 'workout_date', 'description', 'user_id', 'track_event_subtype_id',
    ];

    public function getWorkoutDateForEditingAttribute()
    {
        return $this->workout_date->format('m/d/Y');
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
