<?php

namespace App\Models\Training\Workouts;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HurdleWorkout extends Model
{
    use HasFactory;

    protected $table = 'hurdle_workouts';

    protected $dates = ['workout_date'];

    protected $fillable = [
        'title', 'workout_date', 'description', 'user_id'
    ];

    public function getWorkoutDateForEditingAttribute()
    {
        return $this->workout_date->format('m/d/Y');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
