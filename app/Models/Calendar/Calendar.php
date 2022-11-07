<?php

namespace App\Models\Calendar;

use App\Models\Communication\TeamEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'calendar';

    protected $primaryKey = 'calendar_date';

    public $incrementing = false;

    protected $keyType = 'date';

    protected $casts = [
        'calendar_date' => 'datetime',
    ];

    public function teamEvents(): HasMany
    {
        return $this->hasMany(TeamEvent::class, 'event_date', 'calendar_date');
    }
}
