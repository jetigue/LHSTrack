<?php

namespace App\Models\Communication;

use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamAnnouncement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'team_announcements';
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

    public function getCardColorAttribute(): string
    {
        return [
            true => 'gray-200',
            false => 'white',
        ][$this->expired()] ?? 'white';
    }

    public function expired(): bool
    {
        return $this->end_date < Carbon::now()->format('Y-m-d');
    }
}
