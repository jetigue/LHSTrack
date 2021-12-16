<?php

namespace App\Models\Communication;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamAnnouncement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'team_announcements';

    protected $dates = ['begin_date', 'end_date'];

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
}
