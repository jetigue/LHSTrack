<?php

namespace App\Models\Communication;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamEvent extends Model
{
    use HasFactory;

    protected $table = 'team_events';

    protected $fillable = ['user_id', 'title', 'description', 'event_date'];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function getEventDateForEditingAttribute()
    {
        return $this->event_date->format('m/d/Y');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
